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

// Home
Route::get('/', 'HomepageController@show');
Route::get('home', 'HomepageController@show');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Auctions
Route::get('auction/{id}', 'AuctionController@show');

//User profile
Route::get('user/{id}','UserController@page')->name('profile');
Route::get('user/{id}/edit', 'UserController@editPage')->name('editProfilePage')->middleware('checkSelf');
Route::post('user/{id}/edit', 'UserController@edit')->name('editProfile');
