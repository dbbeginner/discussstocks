<?php

use Illuminate\Support\Facades\Route;

// Routes that unauthenticated users can use
// In a separate file just to reduce clutter

// Homepage
Route::get('/', '\App\Http\Controllers\PostController@recentPosts')->name('home');

// Static pages
Route::get('/terms', '\App\Http\Controllers\StaticController@Terms');
Route::get('/about', '\App\Http\Controllers\StaticController@About');
Route::get('/markdown', '\App\Http\Controllers\StaticController@markdown');

// Registration pages
Route::get('/register', '\App\Http\Controllers\Accounts\RegistrationController@Create');
Route::post('/register', '\App\Http\Controllers\Accounts\RegistrationController@Register');

// Login/Logout pages
Route::get('login', function(){ return view('login'); })->name('login');
Route::post('login', 'App\Http\Controllers\Accounts\LoginController@authenticate');

// List of channels
Route::get('/channels', '\App\Http\Controllers\ChannelController@AllChannels');

// View a single channel
Route::get('/c/{slug}/{hash_id}', '\App\Http\Controllers\PostController@ViewPostsInChannel');

// View a single story in a channel
Route::get('/c/{channel_slug}/{channel_hash_id}/{post_slug}/{post_hash_id}', '\App\Http\Controllers\PostController@viewPost');

// ShortURL straight to channel or post (for social sharing)
Route::get('{hash_id}', '\App\Http\Controllers\Guesser@GuessByHashId');





