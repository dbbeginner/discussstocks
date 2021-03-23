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
require __DIR__.'/account.php';




// List of channels
Route::get('/channels', '\App\Http\Controllers\ChannelController@AllChannels');

// View a single channel
Route::get('/c/{slug}/{hashId}', '\App\Http\Controllers\PostController@ViewPostsInChannel');

// View a single story in a channel
Route::get('/c/{channelSlug}/{channelHashId}/{postSlug}/{postHashId}', '\App\Http\Controllers\PostController@viewPost');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', '\App\Http\Controllers\PostController@create');                                 // Choose whether to post an article or a link

        Route::get('article/create', '\App\Http\Controllers\Create\PostCreationController@index');      // User enters their data
        Route::post('article/verify', '\App\Http\Controllers\Create\PostCreationController@verify');    // User verifies their input
        Route::post('article/store', '\App\Http\Controllers\Create\PostCreationController@store');      // Store user input

        Route::get('url/create', '\App\Http\Controllers\Create\LinkCreationController@index');          // User enters data
        Route::post('url/verify', '\App\Http\Controllers\Create\LinkCreationController@verify');        // User verifies their input
        Route::post('url/store', '\App\Http\Controllers\Create\LinkCreationController@store');          // Store user input
        Route::post('url/ajax', '\App\Http\Controllers\Create\LinkCreationController@titleHelper');     // Ajax responder to preview the title of a link

    });
});


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
        Route::post('subscriptions', 'App\Http\Controllers\UserSubscriptionsController@store');
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
Route::get('/', '\App\Http\Controllers\HomeController@index');
Route::get('/all', '\App\Http\Controllers\HomeController@allPosts');
Route::get('/subscribed', '\App\Http\Controllers\HomeController@subscribedPosts');

// ShortURL straight to channel or post (for social sharing)
// This has got to be the last route, because it matches with everything else.
Route::get('{hash_id}', '\App\Http\Controllers\Guesser@GuessByHashId');
