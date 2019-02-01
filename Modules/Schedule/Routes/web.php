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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'schedule'],
	function()
	{
    Route::get('/', 'ScheduleController@index')->name('indexSchedule');
    Route::get('/edit/{id}', 'ScheduleController@edit')->name('editSchedule');
    Route::get('/update/{id}', 'ScheduleController@update')->name('updateSchedule');
    Route::delete('/jadwal/{id}', 'ScheduleController@destroy')->name('deleteSchedule');
    Route::get('/Create', 'ScheduleController@create')->name('CreateSchedule');
    Route::post('/Save', 'ScheduleController@store')->name('SaveSchedule');
});
