<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // users
    Route::resource('people/users', 'People\UserController');
    Route::resource('people/roles', 'People\RoleController');
    Route::resource('people/abilities', 'People\AbilityController');

    // upload
    Route::resource('upload', 'Upload\UploadController');

    // companies
    Route::resource('companies', 'CompanyController');

    // tenant switch
    Route::get('tenant/{company}','TenantController@switchTenant')->name('tenant.switch');
    // profile
    Route::resource('maintenance/profiles', 'Maintenance\ProfileController');



    // Page Controller
    // Route::get('/home','HomeController@index')->name('home');
    Route::get('/career_conversation','PageController@careerConversation')->name('career_conversation');
    // Route::get('/assessment','PageController@assessment')->name('assessment');

});
