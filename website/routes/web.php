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
Route::get('/home', 'HomepageController@show');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Category
Route::get('category/{id}', 'CategoryController@show')->name('category');

// Auctions
Route::get('auction/{id}', 'AuctionController@show');
Route::get('auction/{id}/edit', 'AuctionController@showEditForm')->name('edit');
Route::post('auction/{id}/edit', 'AuctionController@edit');
Route::get('auction/create', 'AuctionController@showCreateForm')->name('create');
Route::post('auction/create', 'AuctionController@create');
