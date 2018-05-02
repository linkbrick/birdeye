<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use Auth;

use App\Classes\Upload;
use App\Classes\ExcelExport;

use App\SaleInvoice;

class UploadSalesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $row_count = 0;
        $err_count = 0;
        $inserts = [];
        $model = "sale_invoices";
        $columns = config("tablecolumns.$model");

        // save uploaded file to drive
        $sales_invoice = Upload::save($request->file("file_salesInvoice"), $model);

        //read uploaded Excel
        $excel = Excel::load($sales_invoice)->get();
        $_data["account_code"] = Auth::id();
        $_data["created_at"] = date("Y-m-d H:i:s");
        $_data["updated_at"] = $_data["created_at"];

        foreach($excel as $row){
            $data = [];

            // check data format
            // $err_count++ when error found

            // save to $inserts if no error
            foreach($row as $col=>$val){
                if(isset($columns[$col])){
                    $data[$columns[$col]] = $val;
                }
            }

            $inserts[] = array_merge($_data, $data);
            $row_count++;
        }

        if($err_count > 0){
            // dump errors rows if any
        }

        if($row_count){
            // save to db
            SaleInvoice::insert($inserts);
        }

        return redirect('upload-sales-invoice');
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
        ExcelExport::template(new SaleInvoice, true);
    }
}
