<?php

Route::get('/test',function(){
    dd(app(\App\Tenant\Manager::class)->getTenant());
});

Route::get('/home', 'HomeController@index')->name('home');