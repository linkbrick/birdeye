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
    \App\Company::create([
        'name' => 'Codecourse',
        'uuid' => 'b1f4d4b6-3725-11e8-b467-0ed5f89f718b'
    ]);
    //return view('welcome');
});

Auth::routes();
    
Route::group(['middleware' => 'auth'], function () {
    // users
    Route::resource('people/users', 'People\UserController');
    Route::resource('people/roles', 'People\RoleController');
    Route::resource('people/abilities', 'People\AbilityController');

    // profile
    Route::resource('maintenance/profiles', 'Maintenance\ProfileController');

    //Route::get('/home', 'HomeController@index')->name('home');

    // Page Controller
    Route::get('/home','PageController@successionPlanning')->name('home');
    Route::get('/career_conversation','PageController@careerConversation')->name('career_conversation');
    // Route::get('/assessment','PageController@assessment')->name('assessment');
   
});
