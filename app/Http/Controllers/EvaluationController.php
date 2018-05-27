<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use Auth;

use App\Classes\Upload;
use App\Classes\ExcelExport;
use App\Classes\ExcelValidateData;

use App\Evaluation;
use App\Upload as uploadModel;
use App\SaleInvoice;
use App\ARPayment;
use App\PaymentSaleInvoice;
use App\Purchase;
use App\APPayment;
use App\PaymentPurchase;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // point to db table name
    private $pointer = [
        "sales_invoice" => ["title" => "Sales Invoice", "model" => "sale_invoices"],
        "ar_payments" => ["title" => "AR Payment", "model" => "ar_payments"],
        "purchases" => ["title" => "Purchase Order", "model" => "purchases"],
        "ap_payments" => ["title" => "AP Payment", "model" => "ap_payments"],
    ];

    private $month = [
        "01" => "January",
        "02" => "February",
        "03" => "March",
        "04" => "April",
        "05" => "May",
        "06" => "June",
        "07" => "July",
        "08" => "August",
        "09" => "September",
        "10" => "October",
        "11" => "November",
        "12" => "December",
    ];

    public function index()
    {
        $eva = Evaluation::with("upload")->where("account_code", Auth::id())->orderBy("code", "desc")->get();
        $month = $this->month;        
        $year = [];
        $_y = date("Y");
        for($i = -1; $i<2; $i++){
            $year[] = $_y + $i;
        }

        return view("evaluation.list", ["month"=>$month, "year"=>$year, "uploads"=>$this->pointer, "evaluation"=>$eva]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = $request->get("month");
        $year = $request->get("year");
        $code = "$year-$month";
        $me = Auth::id();

        $eva = Evaluation::where("code", $code)->where("account_code", $me)->first();

        if($eva){
            return redirect("evaluation")->withErrors([
                "message"=>"Evaluation for ".$this->month[$month]." $year already been created. Click <a href='".url("evaluation/$eva->id/edit")."'>here</a> to edit."
            ]);
        }

        $eva = new Evaluation;
        $eva->account_code = $me;
        $eva->code = $code;
        $eva->save();

        return redirect("evaluation/$eva->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluation = Evaluation::where("account_code", Auth::id())->where("id", $id)->firstOrFail();
        $uploads = [];
        foreach($this->pointer as $category=>$data){
            $uploads[] = [
                "title" => $data["title"],
                "category" => $category,
                "model" => uploadModel::where("evaluation_id", $id)->where("category", $data["model"])->orderBy("id", "desc")->first()
            ];
        }

        return view("evaluation.form", compact("evaluation", "uploads"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = [];
        $inserts = [];
        $row_index = 1;

        // must be the same name as global var, xxx_file, and function name
        $category = $request->get("_category");

        // check is this category is available
        if(!isset($this->pointer[$category])){
            return redirect("evaluation/$id/edit")->withErrors(["message"=>"Something went wrong. Please check with your system administrator!"]);
        }

        // ensure the upload file is not empty
        $data = $this->validate($request, [
            $category."_file" => 'required'
        ]);

        // get the column names
        $columns = config("tablecolumns.".$this->pointer[$category]["model"]);

        // save file to local drive
        $param = ["account_code"=>Auth::id(), "evaluation_id"=>$id, "model"=>$this->pointer[$category]["model"]];
        $upload = Upload::save($request->file($category."_file"), $param);
        $file = $upload["location"];

        // read uploaded Excel
        $excel = Excel::load($file)->get();

        // start insert into db
        $_data["account_code"] = Auth::id();
        $_data["created_at"] = date("Y-m-d H:i:s");
        $_data["updated_at"] = $_data["created_at"];
        $_data["upload_id"] = $upload["id"];
        foreach($excel as $row){
            $data = [];
            $row_index++;

            // check data format for error
            $check = ExcelValidateData::run($row, $this->pointer[$category]["model"]);
            if($check->error){
                // store error messages
                // invalid data format found
                if(count($check->columns) > 0){
                    $cols = implode(", ", $check->columns);
                    $errors["message"][] =  "<b>Row $row_index:</b> Invalid data format for ".ExcelExport::rename_column($cols);
                }
                // expected column not found
                elseif(count($check->not_found) > 0){
                    $cols = implode(", ", $check->not_found);
                    $errors["message"][] =  "<b>Column Not Found:</b> ".ExcelExport::rename_column($cols);
                    break;
                }

                continue;
            }

            // no error then proceed
            foreach($row as $col=>$val){
                if(isset($columns[$col]) && $columns[$col]!=""){
                    $data[$columns[$col]] = $val;
                }
            }

            // save data to $inserts
            $inserts[] = array_merge($_data, $data);
        }

        // dump errors rows if any
        if(count($errors) > 0){
            Upload::delete($upload["id"]);
            return redirect("evaluation/$id/edit")->withErrors($errors);
        }
        // everything's fine, save to db
        elseif(count($inserts) > 0){
            $this->$category($inserts);
            if($category == "sales_invoice" || $category == "ar_payments"){
                $this->matching_psi($id);
            }elseif($category == "purchases" || $category == "ap_payments"){
                $this->matching_pp($id);
            }

            return redirect("evaluation/$id/edit")->with(
                [
                    "_messages" => [
                        "type" => "success",
                        "messages" => ($row_index-1)." rows were imported."
                    ]
                ]
            );
        }
        // nothing happen, empty excel uploaded
        else{
            Upload::delete($upload["id"]);
            return redirect("evaluation/$id/edit")->withErrors(["message"=>"You have uploaded an empty excel sheet!"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // download templates
    public function template($param)
    {
        $param = str_replace("-", "_", $param);
        ExcelExport::template($this->$param);
    }

    // download upladed excels
    public function download($needle){
        $file = uploadModel::where("account_code", Auth::id())->where("id", $needle)->firstOrFail();
        return response()->download($file->location."/".$file->system_name, $file->file_name);
    }

    // read uploaded excel, return in json format
    public function view_excel($needle){
        $file = uploadModel::where("account_code", Auth::id())->where("id", $needle)->firstOrFail();
        $table = $file->category;
        $select = array_flip(
            config("tablecolumns.$table")
        );
        // remove the column that does not exist in db
        if(isset($select[""])) unset($select[""]);

        $rows = \DB::
                table($table)
                ->select($select)
                ->where("upload_id", $needle)
                ->get()->toArray();
        $data["columns"] = array_keys(array_flip($select));
        $data["rows"] = $rows;

        return response()->json($data);
    }

    private function sales_invoice($inserts){
        SaleInvoice::insert($inserts);
    }

    private function ar_payments($inserts){
        ARPayment::insert($inserts);
    }

    private function purchases($inserts){
        Purchase::insert($inserts);
    }

    private function ap_payments($inserts){
        APPayment::insert($inserts);
    }

    // matching ar payments to sales invoices
    private function matching_psi($id){
        $eva = Evaluation::find($id);

        $upload = uploadModel::where("evaluation_id", $id)->where("category", "ar_payments")->orderBy("id", "desc")->first();
        // ensure the payment file is uploaded
        if(!$upload) return false;

        $file = $upload->location."/".$upload->system_name;
        if(!file_exists($file)) return false;

        $excel = Excel::load($file)->get();
        foreach($excel as $row){
            $payment_number = $row->payment_number;
            $invoice_number = $row->invoice_number;

            $payment = ARPayment::where("payment_number", $payment_number)->first();
            $invoice = SaleInvoice::where("invoice_number", $invoice_number)->first();

            // process abort if any of the record at both side is not found
            if($payment && $invoice){
                // only insert if record not found
                $psi = PaymentSaleInvoice::firstOrNew([
                    "payment_id"=>$payment->id,
                    "sale_invoice_id"=>$invoice->id
                ])->save();
            }
        }
    }

    // matching ap payments to purchase orders
    private function matching_pp($id){
        $eva = Evaluation::find($id);

        $upload = uploadModel::where("evaluation_id", $id)->where("category", "ap_payments")->orderBy("id", "desc")->first();
        // ensure the payment file is uploaded
        if(!$upload) return false;

        $file = $upload->location."/".$upload->system_name;
        if(!file_exists($file)) return false;

        $excel = Excel::load($file)->get();
        foreach($excel as $row){
            $payment_number = $row->payment_number;
            $purchase_order_number = $row->purchase_order_number;

            $payment = APPayment::where("payment_number", $payment_number)->first();
            $purchase = Purchase::where("purchase_order_number", $purchase_order_number)->first();

            // process abort if any of the record at both side is not found
            if($payment && $purchase){
                // only insert if record not found
                $pp = PaymentPurchase::firstOrNew([
                    "payment_id"=>$payment->id,
                    "purchase_id"=>$purchase->id
                ])->save();
            }
        }
    }
}
