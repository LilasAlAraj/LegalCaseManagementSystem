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
    
    Route::resource('cases','App\Http\Controllers\CasesController');  //القضية

    Route::resource('CasesAttachments', 'App\Http\Controllers\CasesAttachmentController'); // مرفقات القضية
     
    Route::resource('sessions','App\Http\Controllers\SessionsController');   // جلسات القضية
  
    Route::get('/CasesDetails/{id}' ,'App\Http\Controllers\CasesDetailsController@edit');  // تفاصيل القضية

    Route::get('/Status_show/{id}', 'CasesController@show')->name('Status_show');        // حالة القضية (رابحة -خاسرة -جاري العمل عليها - مفتوحة )

    Route::post('/Status_Update/{id}', 'CasesController@Status_Update')->name('Status_Update');  // تغيير حالة القضية

    Route::resource('Archive', 'InvoiceAchiveController');   //القضايا المؤرشفة

    Route::get('Case_Winning','CasesController@Case_Winning'); // القضايا الرابحة 

    Route::get('Case_Lost','CasesController@Case_Lost');      // القضايا الخاسرة

    Route::get('Case_Partial','CasesController@Case_Partial');  // قضايا جاري العمل عليها

    Route::get('cases_report','App\Http\Controllers\Cases_ReportController@index'); // نتائج البحث

    Route::post('Search_cases', 'App\Http\Controllers\Cases_ReportController@Search_cases'); // بحث عن قضية حسب مفتاح معين 

    Route::get('MarkAsRead_all','App\Http\Controllers\CasesController@MarkAsRead_all')->name('MarkAsRead_all'); // جعل جميع القضايا في الاشعارات مقروءة 

    Route::get('unreadNotifications_count', 'App\Http\Controllers\CasesController@unreadNotifications_count')->name('unreadNotifications_count'); //عدد الاشعارات الغير المقروءه 

    Route::get('unreadNotifications', 'App\Http\Controllers\CasesController@unreadNotifications')->name('unreadNotifications'); // الرسائل الغير مقروءة

    Route::group(['middleware' => ['auth']], function() { 

    Route::resource('roles','RoleController');

    Route::resource('users','App\Http\Controllers\UserController');
        
        });
