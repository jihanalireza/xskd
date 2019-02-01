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

Route::group(['middleware' => ['checksession','perpustakaan'], 'prefix' => 'borrowbook'],
	function() 
	{
	    Route::get('/', 'BorrowBookController@index')->name('borrowbookIndex');
	    Route::get('/create', 'BorrowBookController@create')->name('createborrowbook.create');
	    Route::post('/store', 'BorrowBookController@store')->name('createborrowbookdata.store');
	    Route::get('/borrowbuku/{id}', 'BorrowBookController@edit');
	    Route::post('/updateborrowbuku', 'BorrowBookController@update')->name('updateborrowbuku');
	    Route::post('/sendInvoice', 'BorrowBookController@sendInvoice')->name('sendInvoice');
	    Route::delete('/delete/{id}', 'BorrowBookController@destroy')->name('deletePinjamBuku');
});
