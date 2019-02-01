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

Route::group(['middleware' => ['checklogin'], 'prefix' => 'authentication'],
	function()
	{
    Route::get('/login', 'AuthenticationController@index')->name('login.form');
    Route::get('/register', 'AuthenticationController@index')->name('register.form');
    Route::post('/register/users', 'AuthenticationController@register')->name('register.store');
    Route::post('/login/users', 'AuthenticationController@login')->name('login.store');
});

Route::get('/logout', 'AuthenticationController@logout')->name('logout.store');
