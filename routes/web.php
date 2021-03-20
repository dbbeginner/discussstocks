<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/static.php';
require __DIR__.'/user.php';


// List of channels
Route::get('/channels', '\App\Http\Controllers\ChannelController@AllChannels');

// View a single channel
Route::get('/c/{slug}/{hashId}', '\App\Http\Controllers\PostController@ViewPostsInChannel');

// View a single story in a channel
Route::get('/c/{channelSlug}/{channelHashId}/{postSlug}/{postHashId}', '\App\Http\Controllers\PostController@viewPost');




Route::group(['middleware' => 'auth'], function () {
    // Paths for registered users to create and delete channels
    Route::group(['prefix' => 'channel'], function() {
        Route::get('create', 'App\Http\Controllers\ChannelController@create');
        Route::post('create', 'App\Http\Controllers\ChannelController@store');
    });
});


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function() {
//        Manage user settings
        Route::get('settings', 'App\Http\Controllers\UserSettingsController@index');
        Route::post('settings', 'App\Http\Controllers\UserSettingsController@store');

//        Manage channel subscriptions
        Route::get('subscriptions', 'App\Http\Controllers\UserSubscriptionsController@index');
        Route::post('subscriptions/save', 'App\Http\Controllers\UserSubscriptionsController@store');
    });
});



Route::post('/vote/', '\App\Http\Controllers\VoteController@store');




//require __DIR__.'/auth.php';


Route::get('/p/{slug}/{hashid}', [\App\Http\Controllers\PostController::class, 'viewPost']);
Route::get('/r/{slug}/{hashid}', [\App\Http\Controllers\ReplyController::class, 'viewReply']);
Route::get('/u/{username}', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/u/{username}/posts', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/u/{username}/replies', [\App\Http\Controllers\UserController::class, 'index']);




// Homepage
Route::get('/', '\App\Http\Controllers\HomepageController@index');
Route::post('/', '\App\Http\Controllers\HomepageController@count');

// ShortURL straight to channel or post (for social sharing)
// This has got to be the last route, because it matches with everything else.
Route::get('{hash_id}', '\App\Http\Controllers\Guesser@GuessByHashId');
