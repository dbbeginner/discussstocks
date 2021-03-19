<?php

use Illuminate\Support\Facades\Route;

// Static pages
Route::get('terms', '\App\Http\Controllers\StaticController@Terms');
Route::get('about', '\App\Http\Controllers\StaticController@About');
Route::get('markdown', '\App\Http\Controllers\StaticController@Markdown');




// List of channels
Route::get('/channels', '\App\Http\Controllers\ChannelController@AllChannels');

// View a single channel
Route::get('/c/{slug}/{hash_id}', '\App\Http\Controllers\PostController@ViewPostsInChannel');

// View a single story in a channel
Route::get('/c/{channel_slug}/{channel_hash_id}/{post_slug}/{post_hash_id}', '\App\Http\Controllers\PostController@viewPost');







