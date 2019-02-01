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

Route::get('/', 'profile@index')->middleware('checksession');
Route::post('/simpansertifikasi','profile@simpansertifikasi')->middleware('checksession');
Route::post('/simpanpendidikan','profile@simpanpendidikan')->middleware('checksession');