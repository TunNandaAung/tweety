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
// auth()->loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::get('/tweets/{tweet}', 'TweetsController@show')->name('show-tweet');
    Route::post('/tweets', 'TweetsController@store')->name('create-tweet');
    Route::delete('/tweets/{tweet}', 'TweetsController@destroy')->name('delete-tweet');

    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store')->name('like-tweet');
    Route::delete('/tweets/{tweet}/like', 'TweetLikesController@destroy')->name('dislike-tweet');

    Route::post('/replies/{reply}/like', 'ReplyLikesController@store')->name('like-reply');
    Route::delete('/replies/{reply}/like', 'ReplyLikesController@destroy')->name('dislike-reply');

    Route::post('/tweets/{tweet}/reply', 'RepliesController@store')->name('create-reply');
    Route::get('/tweets/{tweet}/replies', 'RepliesController@index')->name('replies');
    Route::get('/tweets/{tweet}/replies/{reply}', 'RepliesController@show')->name('show-reply');
    Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('delete-reply');

    Route::post('/profiles/{user}/follow', 'FollowsController@store')->name('follows');
    Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->middleware('can:edit,user')->name('edit-profile');
    Route::patch('/profiles/{user}', 'ProfilesController@update')->middleware('can:edit,user')->name('update-profile');
    
    Route::get('/profiles/{user}/settings', 'SettingsController@edit')->middleware('can:edit,user')->name('account-settings');
    Route::get('/profiles/{user}/password/edit', 'PasswordController@edit')->middleware('can:edit,user')->name('edit-password');
    Route::patch('/profiles/{user}/password', 'PasswordController@update')->middleware('can:edit,user')->name('update-password');
    Route::get('/profiles/{user}/email/edit', 'EmailController@edit')->middleware('can:edit,user', 'password.confirm')->name('edit-email');
    Route::patch('/profiles/{user}/email', 'EmailController@update')->middleware('can:edit,user')->name('update-email');

    Route::get('/explore', 'ExploreController')->name('explore');

    Route::get('/profiles/{user}/followers', 'FollowsController@show')->name('show-followers');
    Route::get('/profiles/{user}/following', 'FollowsController@show')->name('show-following');

    Route::get('/search', 'SearchController@show')->name('show-search');

    Route::get('/notifications', 'NotificationsController@index')->name('notifications');

    Route::get('/chat', 'ChatsController@index')->name('chat');
    Route::get('/chat/{user}', 'ChatsController@show')->name('show-chat');
    Route::get('/chat/{chat}/messages', 'MessagesController@get');
    Route::post('/chat/{chat}/messages', 'MessagesController@store');


    Route::get('/api/friends', 'FriendsController@index');
    Route::get('/api/search-friends', 'Api\FriendsController@index');

    Route::get('/api/replies/{reply}/children', 'Api\ChildrenRepliesController@show');
});

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');
