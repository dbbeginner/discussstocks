<?php

use Illuminate\Support\Facades\Route;

// Routes that unauthenticated users can use
// In a separate file just to reduce clutter

Route::get('/', '\App\Http\Controllers\PostController@recentPosts')->name('home');

Route::get('/terms', '\App\Http\Controllers\StaticController@Terms');
Route::get('/about', '\App\Http\Controllers\StaticController@About');
Route::get('/markdown', '\App\Http\Controllers\StaticController@markdown');


Route::get('/register', '\App\Http\Controllers\Accounts\RegistrationController@Create');
Route::post('/register', '\App\Http\Controllers\Accounts\RegistrationController@Register');


Route::get('/c/{channel_slug}/{channel_hash_id}/{post_slug}/{post_hash_id}', '\App\Http\Controllers\PostController@viewPost');


Route::get('/c/{slug}', '\App\Http\Controllers\Guesser@Channel');
Route::get('/p/{slug}', '\App\Http\Controllers\Guesser@Post');

Route::get('/c/{slug}/{hashid}', '\App\Http\Controllers\PostController@ViewPostsInChannel');
Route::get('/p/{slug}/{hashid}', 'ViewController@PostWithReplies');

Route::get('/channels', '\App\Http\Controllers\ChannelController@AllChannels');

Route::get('login', function(){ return view('login'); })->name('login');
Route::post('login', 'App\Http\Controllers\Accounts\LoginController@authenticate');

Route::get('{hash_id', '\App\Http\Controllers\Guesser@GuessByHashId');