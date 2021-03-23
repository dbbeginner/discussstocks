<?php

use Illuminate\Support\Facades\Route;

// User Account Activation Link
Route::get('activate', '\App\Http\Controllers\Accounts\UserActivationController@create');
Route::post('activate', '\App\Http\Controllers\Accounts\UserActivationController@store');

// Generate and send replacement activation link
Route::get('activate/replace', '\App\Http\Controllers\Accounts\RequestNewActivationToken@create');
Route::post('activate/replace', '\App\Http\Controllers\Accounts\RequestNewActivationToken@store');

// Login/Logout pages
Route::get('login', 'App\Http\Controllers\Accounts\LoginController@create')
    ->name('login');
Route::post('login', 'App\Http\Controllers\Accounts\LoginController@store');
Route::any('logout', 'App\Http\Controllers\Accounts\LoginController@destroy');

// Registration pages
Route::get('register', '\App\Http\Controllers\Accounts\RegistrationController@create');
Route::post('register', '\App\Http\Controllers\Accounts\RegistrationController@store');
