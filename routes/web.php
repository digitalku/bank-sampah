<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/edit/{id}', 'HomeController@editUser')->name('users-edit');
Route::post('/users/update', 'HomeController@updateUsers')->name('users-update');
Route::post('/store-user', 'HomeController@storeUsers')->name('store-user');
Route::get('/category', 'HomeController@createData')->name('category');
Route::post('/store-category', 'HomeController@storeCategory')->name('store-category');
Route::post('/store', 'HomeController@store')->name('store');
Route::get('/edit', 'HomeController@editData')->name('edit');
