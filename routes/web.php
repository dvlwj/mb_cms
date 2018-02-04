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

Route::group(['prefix'],function(){
	Route::resource('order','OrderController');
	Route::get('check_order','OrderController@check')->name('check_order');
	Route::post('process_check_order/{purchace_order_code}','OrderController@process_check')->name('process_check_order');
});
// Route::get('order','OrderController@index')->name('order');
// Route::get('check_order','OrderController@check')->name('check_order');
// Route::get('check_order.get','OrderController@check')->name('check_order');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function() {
	Route::resource('categories', 'CategoriesController');
	Route::resource('products', 'ProductsController');
	Route::resource('users', 'UsersController');
});

Route::group(['prefix' => 'admin','middleware' => 'admin'],function() {
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('is-logged-in', 'Auth\LoginController@isLoggedIn')->name('is.logged.in');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
