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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'schooldata'],
	function()
	{
    Route::get('/', 'SchooldataController@index')->name('indexSchooldata');
    Route::get('/editsekolah/{id_sekolah}', 'SchooldataController@edit')->name('school.edit');
    Route::get('/createsekolah', 'SchooldataController@create')->name('school.create');
    Route::post('/savesekolah', 'SchooldataController@store')->name('school.save');
    Route::patch('/updatesekolah/{id_sekolah}', 'SchooldataController@update')->name('school.update');
    Route::delete('/sekolah/{id_sekolah}', 'SchooldataController@destroy')->name('school.delete');
});
