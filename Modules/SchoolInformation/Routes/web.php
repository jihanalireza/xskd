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

Route::group(['middleware' => ['checksession','admin'], 'prefix' => 'schoolinformation'],
	function()
	{
	Route::get('/', 'SchoolInformationController@index')->name('SchoolInformation.index');
	Route::get('/createInformasisekolah', 'SchoolInformationController@create')->name('createinfosekolah.create');
	Route::post('/storeinfosekolah', 'SchoolInformationController@store')->name('createinfosekolah.store');
	Route::get('/SchoolInformation/{id}', 'SchoolInformationController@edit')->name('SchoolInformation.edit');
	Route::patch('/SchoolInformation/{id}', 'SchoolInformationController@update')->name('SchoolInformation.update');
    Route::delete('/SchoolInformation/{id}', 'SchoolInformationController@destroy')->name('SchoolInformation.delete');

});
