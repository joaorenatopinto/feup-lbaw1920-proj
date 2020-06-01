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
Route::get('home', 'HomepageController@show')->name('home');

// User Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Category
Route::get('category/{id}', 'CategoryController@show')->name('category');

// Auctions
Route::get('auction/create', 'AuctionController@showCreateForm')->name('createAuction');
Route::post('auction/create', 'AuctionController@create');
Route::get('auction/{id}', 'AuctionController@show')->name('auction');
Route::get('auction/{id}/edit', 'AuctionController@showEditForm')->name('editAuction');
Route::post('auction/{id}/edit', 'AuctionController@edit');
Route::post('auction/{id}/bid', 'AuctionController@bid');
Route::get('auction/search/{term}', 'AuctionController@search');

//User profile
Route::get('user/edit', 'UserController@editPage')->name('editPage');
Route::post('user/edit', 'UserController@edit')->name('editProfile');
Route::get('user/{id}','UserController@page')->name('profile');

//Balance
Route::get('user/{id}/statement'. 'UserController@showStatement')->name('showStatement');
Route::get('deposit', 'UserController@showDepositForm')->name('showDeposit');
Route::post('deposit', 'UserController@deposit')->name('deposit');
Route::get('withdrawal', 'UserController@showWithdrawalForm')->name('showWithdrawal');
Route::post('withdrawal', 'UserController@withdrawal')->name('withdrawal');



// Admin Authentication
Route::get('administration', 'Auth\AdminLoginController@showForm')->name('adminLogin');
Route::post('administration', 'Auth\AdminLoginController@login');

//Admin page
Route::get('administration/users', 'AdminController@show');
Route::get('administration/logout', 'Auth\AdminLoginController@logout')->name('adminLogout');


//API
Route::get('api/category/{id}','CategoryController@getCategoryPageAjax');

// Moderation
// Route::get('moderation', function(){return redirect('moderation/users');});
Route::get('moderation/users', 'ModerationController@showUsers');
Route::get('moderation/auctions', 'ModerationController@showAuctions');
Route::get('moderation/reports', 'ModerationController@showReports');
Route::post('user/{id}/ban', 'ModerationController@banUser');
Route::post('auction/{id}/cancel', 'ModerationController@cancelAuction');
