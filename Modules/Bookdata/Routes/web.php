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

Route::group(['middleware' => ['checksession','perpustakaan'], 'prefix' => 'bookdata'],
	function() 
	{
	    Route::get('/', 'BookdataController@index')->name('indexBookdata');
	    Route::get('/createbook', 'BookdataController@create')->name('createbook');
	    Route::post('/createbook_post', 'BookdataController@store')->name('createBookdata.store');
	    Route::get('/buku/{id}', 'BookdataController@edit');
	    Route::post('/update_buku', 'BookdataController@update')->name('update_buku');
    Route::delete('/buku/{id}', 'BookdataController@destroy')->name('Bookdata.delete');
});
