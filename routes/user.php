<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'u'], function () {
    Route::get('{username}', '\App\Http\Controllers\UserController@index');
    Route::get('{username}/posts', '\App\Http\Controllers\UserController@posts');
    Route::get('{username}/replies', '\App\Http\Controllers\UserController@replies');
    Route::get('{username}/mentions', '\App\Http\Controllers\UserController@mentions');
});