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

Route::prefix('psb')->group(function() {
    Route::get('/', 'PSBController@index')->name('indexPSBdata');
    Route::resource('psb', 'PSBController');

});
