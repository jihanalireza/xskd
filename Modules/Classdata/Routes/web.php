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
Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'classdata'],
	function()
	{
    Route::get('/', 'ClassdataController@index')->name('indexClassdata');
    Route::get('/createclass', 'ClassdataController@create')->name('create.class');
    Route::post('/createclass_post', 'ClassdataController@store')->name('createclass.store');
    Route::get('/edit/{id_kelas}', 'ClassdataController@edit')->name('editClassdata');
    Route::delete('/hapus/{id}', 'ClassdataController@destroy')->name('deleteClassdata');
    Route::patch('/update/{id_kelas}', 'ClassdataController@update')->name('updateClassdata');


});
