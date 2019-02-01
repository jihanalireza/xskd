<?php
Route::prefix('message')->group(function() {
    Route::get('/', 'MessageController@index');
});
