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
    return view('auth.login');
});

    Auth::routes();

    Auth::routes(['register'=>false]);  //Don’t allow to user to register

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('cases','App\Http\Controllers\CasesController');  // 🌷القضية

    Route::resource('CasesAttachments', 'App\Http\Controllers\CasesAttachmentController'); // 🌷مرفقات القضية
     
    Route::resource('enemylawyer','App\Http\Controllers\EnemyClientsController');  // 🌷محاميين الخصم

    Route::resource('enemyclient','App\Http\Controllers\EnemyClientsController');  //  🌷الخصم 

    Route::resource('sessions','App\Http\Controllers\SessionsController');   // 🌷جلسات القضية

    Route::resource('desicions','App\Http\Controllers\DesicionsController'); //  🌷قرارات القضية

    Route::resource('courts','App\Http\Controllers\courtsController'); // 🌷المحاكم 
  
    Route::resource('CasesDetails' ,'App\Http\Controllers\CasesDetailsController');  // 🌷تفاصيل القضية

    Route::resource('task','App\Http\Controllers\TasksController');//المهام
    
    Route::resource('task_type','App\Http\Controllers\TasksTypeController');// task type

    Route::post('/update_task_status/{id}', 'TasksController@update_task_status')->name('update_task_status');//تعديل حالة المهمة

    Route::get('download/{cases_number}/{file_name}', 'App\Http\Controllers\CasesAttachmentController@get_file'); // 🌷تنزيل مرفق 

    Route::get('View_file/{cases_number}/{file_name}', 'App\Http\Controllers\CasesAttachmentController@open_file'); //🌷 عرض مرفق

    Route::post('delete_file', 'App\Http\Controllers\CasesAttachmentController@destroy')->name('delete_file'); //   🌷حذف مرفق 

    Route::get('/Status_show/{id}', 'CasesController@show')->name('Status_show');        // حالة القضية (رابحة -خاسرة -جاري العمل عليها - مفتوحة )🌷

    Route::post('/Status_Update/{id}', 'CasesController@Status_Update')->name('Status_Update');  // 🌷تغيير حالة القضية

    Route::resource('Archive', 'InvoiceAchiveController');   // 🌷القضايا المؤرشفة

    Route::get('Case_Winning','CasesController@Case_Winning'); // 🌷القضايا الرابحة 

    Route::get('Case_Lost','CasesController@Case_Lost');      // 🌷القضايا الخاسرة

    Route::get('Case_Partial','CasesController@Case_Partial');  // 🌷قضايا جاري العمل عليها

    Route::get('cases_report','App\Http\Controllers\Cases_ReportController@index'); // 🌷نتائج البحث

    Route::post('Search_cases', 'App\Http\Controllers\Cases_ReportController@Search_cases'); // 🌷بحث عن قضية حسب مفتاح معين 

    Route::get('MarkAsRead_all','App\Http\Controllers\CasesController@MarkAsRead_all')->name('MarkAsRead_all'); // 🌷جعل جميع القضايا في الاشعارات مقروءة 

    Route::get('unreadNotifications_count', 'App\Http\Controllers\CasesController@unreadNotifications_count')->name('unreadNotifications_count'); // 🌷عدد الاشعارات الغير المقروءه 

    Route::get('unreadNotifications', 'App\Http\Controllers\CasesController@unreadNotifications')->name('unreadNotifications'); // 🌷الرسائل الغير مقروءة

    Route::group(['middleware' => ['auth']], function() { 

    Route::resource('roles','RoleController');

    Route::resource('users','App\Http\Controllers\UserController');

        
        });
