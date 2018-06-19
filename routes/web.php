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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');

Route::get('users/exist/email', 'UserController@exist');
Route::get('users/autocomplete', 'UserController@autocomplete');
Route::get('users/profile', 'UserController@profile');
Route::get('users/{id}/avatar', 'UserController@avatar');
Route::post('users/{id}/activate', 'UserController@activate');
Route::resource('users', 'UserController');
Route::resource('mobileUsers', 'MobileUserController');
