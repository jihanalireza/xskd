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

Route::group(['middleware' => ['checksession','keuangan'], 'prefix' => 'spp'],
	function() 
	{
	    Route::get('/', 'SPPController@index')->name('spp.index');
	    Route::get('/createspp', 'SPPController@create')->name('spp.create');
	    Route::post('/postspp', 'SPPController@store')->name('postspp.store');
	    Route::get('/edit/{id}', 'SPPController@edit')->name('SPP.edit');
	    Route::patch('/update', 'SPPController@update')->name('spp.update');
	    Route::delete('/spp/{id}', 'SPPController@destroy')->name('SPP.delete');
});
