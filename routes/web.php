<?php

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

//Route::group(['middleware' => 'guest'], function(){
//    Route::get('/landing', 'LandingPageController@landing')->name('landing');
//});


Route::get('/', function(){
    return view('index');
});

Route::get('/{route}', function(){
   return view('index');
});

//Route::get('{any}', function(){
//    return view('index');
//})->where('any', '([A-z\d-\/_.]+)?');
