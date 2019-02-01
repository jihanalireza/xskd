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

Route::group(['middleware' => ['checksession','perpustakaan'], 'prefix' => 'finetransaction'],
	function() 
	{
	    Route::get('/', 'FineTransactionController@index')->name('FineTransaction.index');
	    Route::get('/edit/{id}', 'FineTransactionController@edit')->name('FineTransaction.edit');
	    Route::get('/Create', 'FineTransactionController@create')->name('FineTransaction.create');
	    Route::post('/Save', 'FineTransactionController@store')->name('FineTransaction.save');
	    Route::patch('/update', 'FineTransactionController@update')->name('FineTransaction.update');
	    Route::delete('/delete/{id}', 'FineTransactionController@destroy')->name('FineTransaction.delete');
});
