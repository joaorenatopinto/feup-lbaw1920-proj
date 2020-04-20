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
Route::get('/', 'Auth\LoginController@home');
Route::get('/home', 'HomeController@show');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// User
Route::get('user/{id}', 'UserController@show');
Route::get('user/{id}/edit', 'UserController@showEditForm');
Route::post('user/{id}/edit', 'UserController@edit');

// Balance

// Auctions
Route::get('auction/{id}', 'AuctionController@show');
Route::get('auction/{id}/bid', 'AuctionController@showBidForm');
Route::post('auction/{id}/bid', 'AuctionController@bid');
Route::get('auction/{id}/review', 'AuctionController@showReviewForm');
Route::post('auction/{id}/review', 'AuctionController@review');
Route::get('auction/create', 'AuctionController@showCreateForm');
Route::post('auction/create', 'AuctionController@create');
Route::get('auction/search/{term}', 'AuctionController@search');
Route::get('category/{id}', 'AuctionController@showCategory');

// Follow
Route::post('auction/{id}/follow', 'AuctionController@follow');
Route::post('category/{id}/follow', 'AuctionController@categoryFollow');

// Moderation
Route::get('moderation/users', 'ModerationController@users');
Route::get('moderation/auctions', 'ModerationController@auctions');
Route::get('moderation/reports', 'ModerationController@reports');
Route::post('moderation/ban/{id}', 'ModerationController@banUser');
Route::post('moderation/cancel/{id}', 'ModerationController@cancelAuction');
Route::post('moderation/recommend/{id}', 'ModerationController@recommendUser');
Route::post('moderation/close/{id}', 'ModerationController@closeReport');

// Administration
Route::get('administration/login', 'AdministrationController@showLoginForm')->name('login');
Route::post('administration/login', 'AdministrationController@login');
Route::get('administration/users', 'AdministrationController@users');
Route::get('administration/auctions', 'AdministrationController@auctions');
Route::get('administration/reports', 'AdministrationController@reports');
Route::get('administration/bugs', 'AdministrationController@bugs');
Route::get('administration/mods', 'AdministrationController@mods');
Route::get('administration/statistics', 'AdministrationController@statistics');
Route::post('administration/ban/{id}', 'AdministrationtionController@banUser');
Route::post('administration/cancel/{id}', 'AdministrationtionController@cancelAuction');
Route::post('administration/perms/{id}', 'AdministrationtionController@changePerms');
Route::post('administration/close/{id}', 'AdministrationtionController@closeReport');
Route::post('administration/close/{id}', 'AdministrationtionController@closeReport');
