<?php

use Illuminate\Support\Facades\Route;

// Routes that unauthenticated users can use
// In a separate file just to reduce clutter

Route::get('/', '\App\Http\Controllers\PostController@recentPosts')->name('home');

Route::get('/terms', '\App\Http\Controllers\StaticController@Terms');
Route::get('/about', '\App\Http\Controllers\StaticController@About');

Route::get('/register', '\App\Http\Controllers\Accounts\RegistrationController@Create');
Route::post('/register', '\App\Http\Controllers\Accounts\RegistrationController@Register');

Route::get('/markdown', '\App\Http\Controllers\StaticController@markdown');


Route::get('/c/{slug}', '\App\Http\Controllers\Guesser@Channel');
Route::get('/p/{slug}', '\App\Http\Controllers\Guesser@Post');

Route::get('/c/{slug}/{hashid}', 'ViewController@PostsInChannel');
Route::get('/p/{slug}/{hashid}', 'ViewController@PostWithReplies');

Route::get('/channels', '\App\Http\Controllers\ChannelController@all');



Route::get('{hash_id', '\App\Http\Controllers\Guesser@GuessByHashId');