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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function() {
	// ini route resource  sudah menangani semua get put delete
	Route::resource('categories', 'CategoriesController');
	Route::resource('products', 'ProductsController');

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('is-logged-in', 'Auth\LoginController@isLoggedIn')->name('is.logged.in');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
