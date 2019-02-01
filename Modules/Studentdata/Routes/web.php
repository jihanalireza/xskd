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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'studentdata'],
	function() 
	{
	    Route::get('/', 'StudentdataController@index')->name('indexStudentdata');
	    Route::get('/createsiswa', 'StudentdataController@create')->name('create.student');
	    Route::post('/createsiswa_post', 'StudentdataController@store')->name('createstudent.store');
	    Route::get('/siswa/{id}', 'StudentdataController@edit');
	    Route::post('/update_siswa', 'StudentdataController@update')->name('update_siswa');
    Route::delete('/siswa/{id}', 'StudentdataController@destroy')->name('studentdata.delete');
});
