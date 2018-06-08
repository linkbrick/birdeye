<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\Upload;
use App\Classes\ExcelExport;
use App\Classes\ExcelValidateData;
use App\AccountPayable;
use App\Bill;
use App\AccountReceivable;

class BatchUploadController extends Controller
{
    private $models;

    public function __construct()
    {
        $this->middleware('check.entity', ['except' => [
            "template"
        ]]);

        $this->models = config("tablecolumns");
    }

    public function index()
    {
        $uploads = [];
        foreach($this->models as $model=>$data){
            $uploads[] = [
                "title" => $data["title"],
                "icon" => $data["icon"],
                "model" => $model
            ];
        }

        return view("upload.index", compact("uploads"));
    }

    public function upload(Request $request)
    {
        $errors = [];
        $inputs = [];
        $row_index = 1;

        // must be the same name as global var, xxx_file, and function name
        $category = $request->get("_model");

        // check is this category is available
        if(!isset($this->models[$category])){
            return redirect("batch_upload")->withErrors(["message"=>"Something went wrong. Please check with your system administrator!"]);
        }

        // ensure the upload file is not empty
        $data = $this->validate($request, [
            $category."_file" => 'required'
        ]);

        // get the column names
        $columns = config("tablecolumns.$category.columns");

        // save file to local drive
        $param = ["model"=>$category];
        $upload = Upload::save($request->file($category."_file"), $param);
        $file = $upload["location"];

        // read uploaded Excel
        $excel = \Excel::load($file)->get();

        // start insert into db
        $_data["entity_id"] = session('entity', 0);
        $_data["created_at"] = date("Y-m-d H:i:s");
        $_data["updated_at"] = $_data["created_at"];

        foreach($excel as $row){
            $data = [];
            $row_index++;

            // check data format for error
            $check = ExcelValidateData::run($row, $category);
            if($check->error){
                // store error messages
                // invalid data format found
                if(count($check->columns) > 0){
                    $cols = implode(", ", $check->columns);
                    $errors["message"][] =  "<b>Row $row_index:</b> Invalid data format for ".ucwords(str_replace("_", " ",$cols));
                }
                // expected column not found
                elseif(count($check->not_found) > 0){
                    $cols = implode(", ", $check->not_found);
                    $errors["message"][] =  "<b>Column Not Found:</b> ".ucwords(str_replace("_", " ",$cols));
                    break;
                }

                continue;
            }

            // no error then proceed
            foreach($row as $col=>$val){
                $data[$col] = $val;
            }

            // save data to $inputs
            $inputs[] = array_merge($_data, $data);
        }

        // dump errors rows if any
        if(count($errors) > 0){
            Upload::delete($upload["id"]);
            return redirect("batch_upload")->withErrors($errors);
        }
        // everything's fine, save to db
        elseif(count($inputs) > 0){
            $this->$category($inputs);

            return redirect("batch_upload")->with(
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
            return redirect("batch_upload")->withErrors(["message"=>"You have uploaded an empty excel sheet!"]);
        }
    }

    public function template($model)
    {
        ExcelExport::template($model);
    }

    private function invoices($inserts){
        foreach($inserts as $k=>$r)
        {
            \App\Invoice::updateOrCreate(
                [
                    "entity_id" => $r["entity_id"],
                    "invoice_number" => $r["invoice_number"]
                ],
                [
                    "customer_code" => $r["customer_code"],
                    "customer_name" => $r["customer_name"],
                    "invoice_date" => $r["invoice_date"],
                    "total_before_tax" => $r["total_before_tax"],
                    "tax" => $r["tax"],
                    "total" => $r["total"]
                ]
            );
        }
    }

    private function account_receivables($inserts){
        foreach($inserts as $k=>$r)
        {
            \App\AccountReceivable::updateOrCreate(
                [
                    "entity_id" => $r["entity_id"],
                    "invoice_id" => $r["invoice_id"]
                ],
                [
                    "payment_amount" => $r["payment_amount"],
                    "payment_date" => $r["payment_date"]
                ]
            );
        }
    }

    private function bills($inserts){
        foreach($inserts as $k=>$r)
        {
            \App\Bill::updateOrCreate(
                [
                    "entity_id" => $r["entity_id"],
                    "bill_number" => $r["bill_number"]
                ],
                [
                    "vendor_code" => $r["vendor_code"],
                    "vendor_name" => $r["vendor_name"],
                    "bill_date" => $r["bill_date"],
                    "total_before_tax" => $r["total_before_tax"],
                    "tax" => $r["tax"],
                    "total" => $r["total"]
                ]
            );
        }
    }

    private function account_payables($inserts){
        foreach($inserts as $k=>$r)
        {
            \App\AccountPayable::updateOrCreate(
                [
                    "entity_id" => $r["entity_id"],
                    "bill_id" => $r["bill_id"]
                ],
                [
                    "payment_amount" => $r["payment_amount"],
                    "payment_date" => $r["payment_date"]
                ]
            );
        }
    }
}
