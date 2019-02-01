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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'teacherdata'],
	function()
	{
		Route::get('/', 'TeacherdataController@index')->name('indexTeacherdata');
		Route::get('/create', 'TeacherdataController@create')->name('createTeacherdata');
		Route::post('/store', 'TeacherdataController@Store')->name('storeTeacherdata');
		Route::get('/edit/{idTeacher}', 'TeacherdataController@edit')->name('formupdateTeacherdata');
		Route::patch('/update/{idTeacher}', 'TeacherdataController@update')->name('updateTeacherdata');
		Route::delete('/guru/{id}', 'TeacherdataController@destroy')->name('deleteTeacherdata');
	});
