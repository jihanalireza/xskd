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

Route::prefix('pembayaranspp')->group(function() {
    Route::get('/', 'PembayaranSppController@index')->name('index.pembayaranspp');
    Route::get('/terimaspp/{id}', 'PembayaranSppController@terima')->name('pembayaranspp.terima');
    Route::get('/tolakspp/{id}', 'PembayaranSppController@tolak')->name('pembayaranspp.tolak');
});
