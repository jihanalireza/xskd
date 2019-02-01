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

Route::group(['middleware' => ['checksession','keuangan'], 'prefix' => 'additionalcosts'],
	function() 
	{
	    Route::get('/', 'AdditionalcostsController@index')->name('Additionalcosts.index');
	    Route::get('/create', 'AdditionalcostsController@create')->name('Additionalcosts.create');
	    Route::post('/adddata', 'AdditionalcostsController@store')->name('Additionalcosts.add');
	    Route::get('/edit/{id}', 'AdditionalcostsController@edit')->name('Additionalcosts.edit');
	    Route::patch('/update', 'AdditionalcostsController@update')->name('Additionalcosts.update');
	    Route::patch('/Acc', 'AdditionalcostsController@Acc')->name('Additionalcosts.acc');
	    Route::delete('/Additional/{id}', 'AdditionalcostsController@destroy')->name('Additionalcosts.delete');
});
