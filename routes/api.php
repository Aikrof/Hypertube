<?php

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

Route::prefix('/oauth')->namespace('Api\V1\OAuth')->group(function(){
    Route::post('/register', 'RegisterController');
    Route::post('/login', 'LoginController');
    Route::post('/logout', 'LogoutController');
    Route::post('/refresh', 'RefreshController');
    Route::post('/logout', 'LogoutController');
});

Route::prefix('/social')->namespace('Api\V1\OAuth')->group(function(){
    Route::get('/{app}', 'SocialiteController@redirectToProvider');
    Route::get('/{app}/callback', 'SocialiteController@providerCallback');
});

Route::middleware('auth:api')->namespace('Api\V1')->group(function(){
    Route::get('/user', 'UserController@getUsers');
    Route::get('/user/{id}', 'UserController@getUserById')->where('id', '[0-9]+');

    Route::get('/movie', 'MoviesController@getMovies');
    Route::get('/movie/{id}', 'MoviesController@getMovieById')->where('id', '[0-9]+');
});
