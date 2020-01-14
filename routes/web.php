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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/users/message/{sender_id}', 'Users@message')->name('users.message');
Route::post('/users/block/{blocked_id}', 'Users@block')->name('users.block');
Route::resource('users', 'Users')->except('show');
Route::get('notify/{sender_id}/{mess_id}','NotificationController@notify')->name('notify-mess');
Route::view('/notification', 'notification');
