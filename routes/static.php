<?php

use Illuminate\Support\Facades\Route;

// Static pages
Route::get('terms', '\App\Http\Controllers\StaticController@Terms');
Route::get('about', '\App\Http\Controllers\StaticController@About');
Route::get('markdown', '\App\Http\Controllers\StaticController@Markdown');
Route::get('privacy-policy', '\App\Http\Controllers\StaticController@Privacy');










