<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)
        ->only(['index', 'create', 'edit']);
    Route::get('users/{hashId}/delete', function(){return "are you sure";});
    Route::get('post/{hashId}/delete', function(){return "are you sure";});
});