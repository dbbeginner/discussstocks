<?php

use Illuminate\Support\Facades\Route;

// User Account Activation Link
Route::get('activate', '\App\Http\Controllers\Accounts\UserActivationController@index');
Route::post('activate', '\App\Http\Controllers\Accounts\UserActivationController@update');

// Generate and send replacement activation link
Route::get('activate/replace', '\App\Http\Controllers\Accounts\RequestNewActivationToken@create');
Route::post('activate/replace', '\App\Http\Controllers\Accounts\RequestNewActivationToken@store');

// Login/Logout pages
Route::get('login', function(){ return view('accounts.login'); })->name('login');
Route::post('login', 'App\Http\Controllers\Accounts\LoginController@authenticate');
Route::any('logout', 'App\Http\Controllers\Accounts\LoginController@Logout');

// Registration pages
Route::get('/register', '\App\Http\Controllers\Accounts\RegistrationController@create');
Route::post('/register', '\App\Http\Controllers\Accounts\RegistrationController@store');
