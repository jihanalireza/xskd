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

Route::group(['middleware' => ['checksession','guru'], 'prefix' => 'score'],
	function()
	{
    Route::get('/', 'ScoreController@index')->name('indexScoredata');
    Route::get('/nilai/{id}', 'ScoreController@edit')->name('editScoredata');
    Route::get('/create', 'ScoreController@create')->name('createScoredata');
    Route::get('/Showsiswa', 'ScoreController@showsiswa')->name('showSiswa');
    Route::post('/nilai', 'ScoreController@update')->name('update_nilai');
    Route::post('/Savesiswa', 'ScoreController@store')->name('saveScoredata');
    Route::delete('/delete/{id}', 'ScoreController@destroy')->name('deleteScoredata');
});
