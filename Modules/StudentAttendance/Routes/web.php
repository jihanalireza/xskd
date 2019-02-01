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

Route::group(['middleware' => ['checksession','guru'], 'prefix' => 'studentattendance'],
	function()
	{
	    Route::get('/', 'StudentAttendanceController@index')->name('studentattendance.index');
	    Route::get('/show_student/{id}', 'StudentAttendanceController@show')->name('studentattendance.show');
	    Route::POST('/procces_Absent', 'StudentAttendanceController@absent');
	    Route::get('/loaddatastudent', 'StudentAttendanceController@loaddatastudent');
	    Route::get('/loaddataabsent', 'StudentAttendanceController@loaddataabsent');
});
