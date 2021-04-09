<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(\App\Http\Middleware\AdminMiddleware::class)
    ->group(function(){
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('channels', \App\Http\Controllers\Admin\ChannelController::class);
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('replies', \App\Http\Controllers\Admin\ReplyController::class);
        Route::resource('mentions', \App\Http\Controllers\Admin\MentionController::class);

    });
