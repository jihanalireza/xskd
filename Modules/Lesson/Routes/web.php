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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'lesson'],
	function()
	{
	    Route::patch('/update/{id_mapel}', 'LessonController@update')->name('updatelesson');
	    Route::get('/edit/{id_mapel}', 'LessonController@edit')->name('editlesson');
	    Route::get('/', 'LessonController@index')->name('index.lesson');
	    Route::get('/createlesson', 'LessonController@create')->name('create.lesson');
	    Route::post('/storelesson', 'LessonController@store')->name('store.lesson');
    Route::delete('/matapelajaran/{id}', 'LessonController@destroy')->name('delete.lesson');
});
