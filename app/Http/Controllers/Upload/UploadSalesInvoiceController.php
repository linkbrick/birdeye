<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use Auth;

use App\Classes\Upload;
use App\Classes\ExcelExport;
use App\Classes\ExcelValidateData;

use App\SaleInvoice;

class UploadSalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model = "sale_invoices";

    public function index()
    {
        return view("upload.sales-invoice");
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
        $errors = [];
        $inserts = [];
        $row_index = 1;
        $columns = config("tablecolumns.$this->model");

        // save uploaded file to drive
        $sales_invoice = Upload::save($request->file("file_salesInvoice"), $this->model);

        //read uploaded Excel
        $excel = Excel::load($sales_invoice)->get();

        $_data["account_code"] = Auth::id();
        $_data["created_at"] = date("Y-m-d H:i:s");
        $_data["updated_at"] = $_data["created_at"];
        foreach($excel as $row){
            $data = [];
            $row_index++;

            // check data format for error
            $check = ExcelValidateData::run($row, $this->model);
            if($check->error){
                // do something here
                $cols = implode(", ", $check->columns);
                $errors["message"][] =  "<b>Row $row_index:</b> Invalid data format for ".ExcelExport::rename_column($cols);

                continue;
            }

            // no error then proceed
            foreach($row as $col=>$val){
                if(isset($columns[$col])){
                    $data[$columns[$col]] = $val;
                }
            }

            // save data to $inserts
            $inserts[] = array_merge($_data, $data);
        }

        // dump errors rows if any
        if(count($errors) > 0){
            return redirect('upload-sales-invoice')->withErrors($errors);
        }
        // save to db
        elseif(count($inserts) > 0){
            SaleInvoice::insert($inserts);
            return redirect('upload-sales-invoice')->with(
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
            return redirect('upload-sales-invoice')->withErrors(["message"=>"Nothing was imported!"]);
        }
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
        //
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
        //
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

    public function template()
    {
        ExcelExport::template($this->model);
    }
}
