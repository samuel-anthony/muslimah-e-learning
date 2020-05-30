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



Route::get('/safira','CustomLoginController@test');


Route::get('/','CustomLoginController@index')->name('login');
Route::get('/home','CustomLoginController@index');
Route::get('/contactus','CustomLoginController@contactus');

Auth::routes();

Route::post('/login','CustomLoginController@login');
Route::get('/sendEmailRegister/{id}/{pass}', 'mailController@mailsendregister');


Route::prefix('user')->group(function (){    
    Route::get('/','UserController@index');
    Route::get('/profile','UserController@profile');
    Route::get('/ubahpassword','UserController@changepassword');
    Route::get('/materi','UserController@materi');  
    Route::get('/openMateri/{id}','UserController@openMateri');  
    Route::get('/ujian','UserController@ujian');  

    Route::post('/profile','UserController@postChangeProfile');
    Route::post('/ubahpassword','UserController@postChangepassword');
    Route::post('/ujian','UserController@ujianStart');  
    Route::post('/saveAnswer','UserController@saveAnswer');  
    Route::post('/submitAnswer','UserController@submitAnswer');  
});

Route::prefix('admin')->group(function (){    
    Route::get('/','AdminController@index');  
    Route::get('/materi','AdminController@materi');  
    Route::get('/ujian','AdminController@ujian');  
    Route::get('/anggota','AdminController@anggota');
    Route::get('/group','AdminController@group');
    Route::get('/ranking','AdminController@ranking');
    Route::get('/editUjian/{id}','AdminController@editUjian');
    Route::get('/editMateri/{id}','AdminController@editMateri');
    Route::get('/editMateri/{id}/{detailid}','AdminController@editMateriDetailPage');
    Route::get('/editPertanyaan/{id}','AdminController@editPertanyaan');
    


    Route::post('/tambahanggota','AdminController@register');
    Route::post('/deleteAnggota','AdminController@deleteAnggota');
    Route::post('/group','AdminController@tambahGroup');
    Route::post('/ujian','AdminController@tambahUjian');
    Route::post('/submitEditUjian','AdminController@submitEditUjian');
    Route::post('/deleteUjian','AdminController@deleteUjian');
    Route::post('/submitPertanyaan','AdminController@submitPertanyaan');
    Route::post('/submitEditPertanyaan','AdminController@submitEditPertanyaan');
    Route::post('/deletePertanyaan','AdminController@deletePertanyaan');
    Route::post('/materi','AdminController@tambahMateri');
    Route::post('/submitMateriDetail','AdminController@submitMateriDetail');
    Route::post('/deleteMateriDetail','AdminController@deleteMateriDetail');
    Route::post('/editMateriDetail','AdminController@editMateriDetail');
    Route::post('/exportGroupData','AdminController@groupDetail');
});