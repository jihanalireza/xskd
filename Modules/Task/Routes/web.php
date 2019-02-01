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
Route::group(['middleware' => ['checksession','guru'], 'prefix' => 'task'],
	function()
	{
	    Route::get('/', 'TaskController@index')->name('task.index');
	    Route::get('/createtask', 'TaskController@create')->name('create.task');
	    Route::post('/createtask_post', 'TaskController@store')->name('createtask.store');
	    Route::get('/edittask/{id_task}', 'TaskController@edit')->name('edit.task');
	    Route::patch('/updatetask/{id_task}', 'TaskController@update')->name('update.task');
	    Route::delete('/delete/{id_task}', 'TaskController@destroy')->name('deleteTask');
});
