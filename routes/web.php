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



Route::get('/','CustomLoginController@index')->name('login');
Route::get('/contactus','CustomLoginController@contactus');

Auth::routes();

Route::post('/login','CustomLoginController@login');
Route::get('/sendEmailRegister/{id}/{pass}', 'mailController@mailsendregister');


Route::prefix('user')->group(function (){    
    Route::get('/','UserController@index');
    Route::get('/profile','UserController@profile');
    Route::get('/ubahpassword','UserController@changepassword');
});

Route::prefix('admin')->group(function (){    
    Route::get('/','AdminController@index');  
    Route::get('/materi','AdminController@materi');  
    Route::get('/ujian','AdminController@ujian');  
    Route::get('/anggota','AdminController@anggota');
    Route::post('/tambahanggota','AdminController@register');
});