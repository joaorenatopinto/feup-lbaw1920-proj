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
Route::get('/home', 'HomepageController@show')->name('home');

// User Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Category
Route::get('category/{id}', 'CategoryController@show')->name('category');

// Auctions
Route::get('auction/create', 'AuctionController@showCreateForm')->name('createAuction');
Route::post('auction/create', 'AuctionController@create');
Route::get('auction/{id}', 'AuctionController@show')->name('auction');
Route::get('auction/{id}/edit', 'AuctionController@showEditForm')->name('editAuction');
Route::post('auction/{id}/edit', 'AuctionController@edit');

//User profile
Route::get('user/{id}','UserController@page')->name('profile');
Route::get('user/{id}/edit', 'UserController@editPage')->name('editProfilePage');
Route::post('user/{id}/edit', 'UserController@edit')->name('editProfile');

// Admin Authentication
Route::get('administrator', 'Auth\AdminLoginController@showForm')->name('adminLogin');
Route::post('administrator', 'Auth\AdminLoginController@login');

//Admin page
Route::get('administration', 'AdminController@show');
/*
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
*/

//API
Route::get('api/category/{id}','CategoryController@getCategoryPageAjax');
