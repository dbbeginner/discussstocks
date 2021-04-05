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

require __DIR__.'/auth.php';
require __DIR__.'/static.php';
require __DIR__.'/user.php';
require __DIR__.'/admin.php';




// Homepage
Route::get('/', '\App\Http\Controllers\HomeController@index')
    ->name('home');
Route::get('/all', '\App\Http\Controllers\HomeController@allPosts')
    ->name('all-posts');
Route::get('/subscribed', '\App\Http\Controllers\HomeController@subscribedPosts')
    ->name('subscribed-posts');



// List of channels
Route::get('/channels/{param?}', '\App\Http\Controllers\ChannelController@index')
    ->name('channels');
Route::get('/channels/oldest', '\App\Http\Controllers\ChannelController@oldest')
    ->name('channels-oldest');
Route::get('/channels/newest', '\App\Http\Controllers\ChannelController@newest')
    ->name('channels-newest');
Route::get('/channels/most-active', '\App\Http\Controllers\ChannelController@mostActive')
    ->name('channels-most-active');
Route::get('/channels/least-active', '\App\Http\Controllers\ChannelController@leastActive')
    ->name('channels-least-active');
Route::get('/channels/ascending', '\App\Http\Controllers\ChannelController@ascending')
    ->name('channels-ascending');
Route::get('/channels/descending', '\App\Http\Controllers\ChannelController@descending')
    ->name('channels-descending');
Route::get('/channels/random', '\App\Http\Controllers\ChannelController@random')
    ->name('channels-random');
Route::get('/channels/most-recently-active', '\App\Http\Controllers\ChannelController@mostRecentlyActive')
    ->name('channels-random');
Route::get('/channels/least-recently-active', '\App\Http\Controllers\ChannelController@leastRecentlyActive')
    ->name('channels-random');


// View a single channel
Route::get('/c/{slug}/{hashId}', '\App\Http\Controllers\HomeController@postsInChannel');
Route::get('/c/{slug}/{hashId}/settings', '\App\Http\Controllers\Channel\ChannelSettings@index');
Route::post('/c/{slug}/{hashId}/settings', '\App\Http\Controllers\Channel\ChannelSettings@store');


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
    Route::post('reply', 'App\Http\Controllers\ReplyController@store');
});


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function() {
        Route::get('profile', 'App\Http\Controllers\User\ProfileController@index');
        Route::get('profile/edit', 'App\Http\Controllers\User\ProfileController@edit');
        Route::post('profile/edit', 'App\Http\Controllers\User\ProfileController@verify');
        Route::post('profile', 'App\Http\Controllers\User\ProfileController@store');

        Route::get('email', 'App\Http\Controllers\User\EmailController@index');
        Route::post('email', 'App\Http\Controllers\User\EmailController@store');

        Route::get('password', 'App\Http\Controllers\User\PasswordChangeController@index');
        Route::post('password', 'App\Http\Controllers\User\PasswordChangeController@store');

        Route::get('settings', 'App\Http\Controllers\User\ProfileController@index');
        Route::post('settings', 'App\Http\Controllers\User\ProfileController@store');

//        Manage user settings
        Route::get('settings', 'App\Http\Controllers\User\SettingsController@index');
        Route::post('settings', 'App\Http\Controllers\User\SettingsController@store');

//        Manage channel subscriptions
        Route::get('subscriptions', 'App\Http\Controllers\User\SubscriptionsController@index');
        Route::post('subscriptions', 'App\Http\Controllers\User\SubscriptionsController@store');
    });
});



Route::post('/vote/', '\App\Http\Controllers\VoteController@store');






Route::get('/p/{slug}/{hashid}', [\App\Http\Controllers\PostController::class, 'viewPost']);
Route::get('/r/{slug}/{hashid}', [\App\Http\Controllers\ReplyController::class, 'viewReply']);



// ShortURL straight to channel or post (for social sharing)
// This has got to be the last route, because it matches with everything else.
Route::get('{hash_id}', '\App\Http\Controllers\Guesser@GuessByHashId');
