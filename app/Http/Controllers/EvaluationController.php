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
use App\Payment;
use App\PaymentSaleInvoice;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // point to db table name
    private $sales_invoice = "sale_invoices";
    private $payments = "payments";

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
        $eva = Evaluation::where("account_code", Auth::id())->orderBy("code", "desc")->get();
        $month = $this->month;

        $year = [];
        $_y = date("Y");
        for($i = -1; $i<2; $i++){
            $year[] = $_y + $i;
        }

        return view("evaluation.list", ["month"=>$month, "year"=>$year, "evaluation"=>$eva]);
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
                "message"=>"Evaluation for ".$this->month[$month]." $year already been created."
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
        $eva = Evaluation::where("account_code", Auth::id())->where("id", $id)->firstOrFail();
        $invoice = uploadModel::where("evaluation_id", $id)->where("category", "sale_invoices")->orderBy("id", "desc")->first();
        $payment = uploadModel::where("evaluation_id", $id)->where("category", "payments")->orderBy("id", "desc")->first();

        return view("evaluation.form", ["evaluation"=>$eva, "invoice"=>$invoice, "payment"=>$payment]);
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

        //must be the same name as global var, file_, and function name
        $category = $request->get("_category");

        $columns = config("tablecolumns.".$this->$category);

        // save uploaded file to drive
        $param = ["account_code"=>Auth::id(), "evaluation_id"=>$id, "model"=>$this->$category];
        $upload = Upload::save($request->file("file_".$category), $param);
        $file = $upload["location"];

        //read uploaded Excel
        $excel = Excel::load($file)->get();

        $_data["account_code"] = Auth::id();
        $_data["created_at"] = date("Y-m-d H:i:s");
        $_data["updated_at"] = $_data["created_at"];
        $_data["upload_id"] = $upload["id"];
        foreach($excel as $row){
            $data = [];
            $row_index++;

            // check data format for error
            $check = ExcelValidateData::run($row, $this->$category);
            if($check->error){
                // store error messages
                $cols = implode(", ", $check->columns);
                $errors["message"][] =  "<b>Row $row_index:</b> Invalid data format for ".ExcelExport::rename_column($cols);

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
            uploadModel::find($upload["id"])->delete();
            return redirect("evaluation/$id/edit")->withErrors($errors);
        }
        // save to db
        elseif(count($inserts) > 0){
            $this->$category($inserts);
            $this->matching_psi($id);

            return redirect("evaluation/$id/edit")->with(
                [
                    "_messages" => [
                        "type" => "success",
                        "messages" => ($row_index-1)." rows were imported."
                    ]
                ]
            );
        }
        // when nothing happen
        else{
            uploadModel::find($upload["id"])->delete();
            return redirect("evaluation/$id/edit")->withErrors(["message"=>"Nothing was imported!"]);
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

    public function template($param)
    {
        $param = str_replace("-", "_", $param);
        ExcelExport::template($this->$param);
    }

    public function download($needle){
        $file = uploadModel::where("account_code", Auth::id())->where("id", $needle)->firstOrFail();
        return response()->download($file->location."/".$file->system_name, $file->file_name);
    }

    private function sales_invoice($inserts){
        SaleInvoice::insert($inserts);
    }

    private function payments($inserts){
        Payment::insert($inserts);
    }

    private function matching_psi($id){
        $eva = Evaluation::find($id);

        $upload = uploadModel::where("evaluation_id", $id)->where("category", "payments")->orderBy("id", "desc")->first();
        if(!$upload) return false;

        $file = $upload->location."/".$upload->system_name;
        if(!file_exists($file)) return false;

        $excel = Excel::load($file)->get();
        foreach($excel as $row){
            $payment_number = $row->payment_number;
            $invoice_number = $row->invoice_number;

            $payment = Payment::where("payment_number", $payment_number)->first();
            $invoice = SaleInvoice::where("invoice_number", $invoice_number)->first();

            if($payment && $invoice){
                $psi = PaymentSaleInvoice::firstOrNew([
                    "payment_id"=>$payment->id,
                    "sale_invoice_id"=>$invoice->id
                ])->save();
            }
        }
    }
}
