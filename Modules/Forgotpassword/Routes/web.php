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

Route::prefix('forgotpassword')->group(function() {
    Route::get('/', 'ForgotpasswordController@index')->name('forgotpassword.form');
    Route::get('/resetpassword/{token}','ForgotpasswordController@verify')->name('resetpassword');
    Route::patch('/resetpassword', 'ForgotpasswordController@update')->name('forgotpassword.reset');
    Route::post('/sendmail', 'ForgotpasswordController@sendmail')->name('forgotpassword.sendmail');
});
