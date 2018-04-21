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
    
    Route::post('api/task_list/career_conversation/add_report', 'SuccessionPlanningController@addReportCCbyId');

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



    Route::get('/getSuggestionByName/{name}', 'TalentProfileController@getSuggestionByName');
    Route::get('/getSPDetailsByID/{talent_id}', 'TalentProfileController@getSPDetailsByID');

    Route::post('/talent_list_nominate', 'SuccessionPlanningController@store')->name('succession_planning.store');

    Route::get('getSPDetailsByID/{talent_id}', 'SuccessionPlanningController@getSPDetailsByID');
    Route::get('getSuggestionByName/{name}', 'TalentProfileController@getSuggestionByName');
    //TASK LIST-SP LIST
    Route::get('/task_list/nomination_list/', 'DivisionController@groupViewSPlist')->name('task_list.sp_group_list');

    Route::get('/task_list/nomination_list/{division_id}', 'DivisionController@divisionViewSPlist')->name('task_list.sp_list');

    //HOD
    Route::post('/task_list/remove', 'SuccessionPlanningController@removeSPByID')->name('task_list.sp_list_remove');
    Route::post('/task_list/approve_sp', 'SuccessionPlanningController@updateNewSP');
    Route::post('/task_list/nominate', 'SuccessionPlanningController@nominateSP');
    //HCM

    //HCM

    Route::post('/task_list/approve', 'SuccessionPlanningController@approveSPByID');
    Route::post('/task_list/reject', 'SuccessionPlanningController@rejectSPByID');
    Route::post('/task_list/removal/approve', 'SuccessionPlanningController@approveRemovalSPByID');
    Route::post('/task_list/removal/reject', 'SuccessionPlanningController@rejectRemovalSPByID');
    Route::post('/task_list/removal/approve/tagToHIPO', 'SuccessionPlanningController@approveRemovalTagHipoSPByID');
    Route::get('/task_list/removal/approve/update/{spid}', 'SuccessionPlanningController@getSPNominationByID');
    Route::post('/task_list/removal/approve/update_SP', 'SuccessionPlanningController@updateSP');
    Route::get('/task_list/get_nomination_list/{division_id}', 'DivisionController@getallSPlist');
    //TASK LIST-CC
    Route::get('/task_list/career_conversation', 'DivisionController@groupViewCC')->name('task_list.cc_group_list');
    Route::get('/task_list/career_conversation/{division_id}', 'DivisionController@divisionViewCC')->name('task_list.cc_list');
    Route::get('/task_list/get_career_conversation_list/{division_id}', 'DivisionController@getallCClist');

    Route::post('/task_list/career_conversation/proceed', 'SuccessionPlanningController@proceedCCbyId');
    Route::post('/task_list/career_conversation/waive', 'SuccessionPlanningController@proceedCCbyId');
    Route::post('/task_list/career_conversation/add_report', 'SuccessionPlanningController@addReportCCbyId');

    //TASK LIST -ASSESMENT
    //VIEW
    Route::get('/task_list/assessment/', 'DivisionController@groupViewAssessment')->name('task_list.assessment_group_list');
    Route::get('/task_list/assessment/{division_id}', 'DivisionController@groupViewAssessment')->name('task_list.assessment_list');

    //POST
    Route::post('/task_list/assessment/assessment_type', 'SuccessionPlanningController@assessmentTypeById');
    Route::post('/task_list/assessment/add_score', 'SuccessionPlanningController@assessmentAddScoreById');

    //TASK LIST - IDP
    //VIEW
    Route::get('/task_list/idp/', 'DivisionController@groupViewAssessment')->name('');
    Route::get('/task_list/idp/{division_id}', 'DivisionController@groupViewAssessment')->name('');

    //POST
    Route::post('/task_list/idp/initiate', 'SuccessionPlanningController@initiateIDPById');
    Route::post('/task_list/idp/review', 'SuccessionPlanningController@waiveIDPById');
    Route::post('/task_list/idp/mentor', 'SuccessionPlanningController@mentorIDPById');
    // Route::post('/task_list/idp/mentee', 'SuccessionPlanningController@menteeIDPById');
    Route::post('/task_list/idp/mentor_comment', 'SuccessionPlanningController@mentorCommentIDPById');



    //SP List Review
    Route::get('maintenance/index', 'Maintenance\SPListReviewController@index')->name('maintenance.index');
    Route::post('maintenance/spListReview/update', 'Maintenance\SPListReviewController@update')->name('spListReview_update');
    Route::post('maintenance/spListReview/{review}/changeStatus','Maintenance\SPListReviewController@changeStatus')->name('spListReview_changeStatus');

    Route::get('/talent_list', 'TalentProfileController@index')->name('talent_profiles.index');
   
});
