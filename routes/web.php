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

    Route::get('/login','App\Http\Controllers\LoginController@show_login_form')->name('login');
    Route::post('/login','App\Http\Controllers\LoginController@process_login')->name('login');
    Route::post('/logout','App\Http\Controllers\LoginController@logout')->name('logout');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('Accounts','App\Http\Controllers\AccountsController');
