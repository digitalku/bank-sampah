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
Route::get('/setor/edit/{id}', 'HomeController@editSetor')->name('setor-edit');
Route::post('/setor/update', 'HomeController@updateSetor')->name('setor-update');
Route::get('/delete-setor/{id}', 'HomeController@deleteSetor')->name('delete-setor');
Route::get('/users/lihat/delete-setoruser/{id}', 'HomeController@deleteSetorUser')->name('delete-setoruser');
Route::get('/sampah', 'HomeController@sampah')->name('sampah');
Route::get('/users/lihat/{id}', 'HomeController@lihatUser')->name('users-lihat');
Route::get('/users/edit/{id}', 'HomeController@editUser')->name('users-edit');
Route::post('/users/update', 'HomeController@updateUsers')->name('users-update');
Route::post('/store-user', 'HomeController@storeUsers')->name('store-user');
Route::get('/delete-user/{id}', 'HomeController@deleteUser')->name('delete-user');
Route::get('/category', 'HomeController@createData')->name('category');
Route::post('/store-category', 'HomeController@storeCategory')->name('store-category');
Route::post('/store', 'HomeController@store')->name('store');
Route::post('/users/lihat/store', 'HomeController@storeWithUser')->name('storeWithUser');
Route::get('/edit-category/{id}', 'HomeController@editCategory')->name('edit-category');
Route::post('/category/update', 'HomeController@updateCategory')->name('category-update');
Route::get('/delete-category/{id}', 'HomeController@deleteCategory')->name('delete-category');
