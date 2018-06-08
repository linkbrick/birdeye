<?php

Route::get('/test',function(){
    dd(app(\App\Tenant\Manager::class)->getTenant());
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices', 'InvoiceController');
Route::resource('account_receivables', 'AccountReceivableController');
Route::resource('bills', 'BillController');
Route::resource('account_payables', 'AccountPayableController');
Route::resource('entities', 'EntityController');
Route::get('entities/{company}/switch','EntityController@switchEntity')->name('entity.switch');
Route::get('batch_upload', 'BatchUploadController@index')->name('batch.upload');
Route::get('batch_upload/template/{template}', 'BatchUploadController@template');
Route::post('batch_upload', 'BatchUploadController@upload');
