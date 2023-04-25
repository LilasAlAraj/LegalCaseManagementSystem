<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('cases','App\Http\Controllers\CasesController');

    Route::resource('CasesAttachments', 'CasesAttachmentController');

    Route::get('/CasesDetails/{id}' ,'App\Http\Controllers\CasesDetailsController@edit');

    Route::get('/Status_show/{id}', 'CasesController@show')->name('Status_show');

    Route::post('/Status_Update/{id}', 'CasesController@Status_Update')->name('Status_Update');

    Route::resource('Archive', 'InvoiceAchiveController');

    Route::get('Case_Winning','CasesController@Case_Winning');

    Route::get('Case_Lost','CasesController@Case_Lost');

    Route::get('Case_Partial','CasesController@Case_Partial');

    Route::get('cases_report','App\Http\Controllers\Cases_ReportController@index');

    Route::post('Search_cases', 'App\Http\Controllers\Cases_ReportController@Search_cases');

    Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles','RoleController');

    Route::resource('users','App\Http\Controllers\UserController');
        
        });
