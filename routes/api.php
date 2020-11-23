<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
    'middleware' => 'auth:sanctum',
    'namespace' => 'Api'
],
    function () {
        Route::get('/tweets', 'TweetsController@index');

        Route::get('/tweets/{tweet}/replies', 'RepliesController@index');
        Route::post('/tweets', 'TweetsController@store');
        Route::delete('/tweets/{tweet}', 'TweetsController@destroy');
    
        Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
        Route::delete('/tweets/{tweet}/dislike', 'TweetLikesController@destroy');
    
        Route::get('replies/{reply}/children/json', 'ChildrenRepliesController@jsonShow');
        Route::post('/tweets/{tweet}/reply', 'RepliesController@store');
        Route::post('/tweets/{tweet}/reply', 'RepliesController@store');

        Route::post('/replies/{reply}/like', 'ReplyLikesController@store');
        Route::delete('/replies/{reply}/dislike', 'ReplyLikesController@destroy');
        Route::delete('/replies/{reply}', 'RepliesController@destroy');
        Route::get('/replies/{reply}', 'RepliesController@show');

        Route::get('/profile/avatar', 'UserAvatarController@show');
        Route::get('/profile', 'ProfilesController@index');
        Route::get('/profiles/{user}', 'ProfilesController@show');
        Route::patch('/profiles/{user}', 'ProfilesController@update');
    
        Route::get('/profiles/{user}/tweets', 'ProfileTweetsController@show');
        Route::get('/profiles/{user}/replies', 'ProfileRepliesController@show');

        Route::post('/profiles/{user}/follow', 'FollowsController@store');
        Route::get('/profiles/{user}/following', 'FollowsController@show')->name('api-show-following');
        Route::get('/profiles/{user}/followers', 'FollowsController@show');

        Route::patch('/auth/email', 'EmailController@update');
        Route::patch('/auth/password', 'PasswordController@update');

        Route::get('/explore', 'ExploreController');

        Route::get('/notification-counts', 'NotificationCountsController');
        Route::get('/notifications', 'NotificationsController@index');

        Route::get('search', 'SearchController@show');
    
        Route::get('/mention', 'MentionUsersController');
    
        Route::post('/logout', 'AuthController@logout');

        Route::post('/profile-images', 'UserAvatarController@store');

        Route::get('/chat', 'ChatsController@index');
        Route::get('/chat/{chat}/messages', 'MessagesController@get');
        Route::post('/chat/{chat}/messages', 'MessagesController@store');
        Route::patch('/chat/{chat}/messages/{user}/read', 'MessagesController@update');
    }
);

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('password/forgot', 'Api\ForgotPasswordController');

Broadcast::routes(['middleware' => ['auth:sanctum']]);
