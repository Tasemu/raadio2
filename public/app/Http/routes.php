<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);
Route::get('anime/{id}', ['as' => 'anime.show', 'uses' => 'AnimeController@show']);

// Authentication routes...
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'processlogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'processregister', 'uses' => 'Auth\AuthController@postRegister']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('tracks/anime', ['as' => 'tracks.setanime', 'uses' => 'TrackController@setAnime']);
	Route::resource('tracks', 'TrackController');	
});

