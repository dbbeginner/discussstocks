<?php

use Illuminate\Support\Facades\Route;

// Note that this route has a prefix
Route::get('report', 'App\Http\Controllers\Modals\ReportContentController@index')
    ->prefix('modals')
    ->middleware('auth');

// Note that this route does not have a prefix
Route::post('report', 'App\Http\Controllers\Modals\ReportContentController@store')
    ->middleware('auth');