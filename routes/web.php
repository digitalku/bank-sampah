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

// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
	Route::get('/home', 'UserController@index')->name('home');
	Route::get('/list-users-admin', 'UserController@ListUserAdmin')->name('list-users-admin');
	Route::get('/list-users-petugas', 'UserController@ListUserPetugas')->name('list-users-petugas');
	Route::get('/list-setor-users', 'UserController@ListUserSetor')->name('list-setor-users');
	Route::get('/list-setor-byusers/{id}', 'UserController@ListSetorByUsers')->name('list-setor-byusers');
	Route::get('delete/users/{id}', 'UserController@destroy')->name('delete-users');
	// Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/setor/edit/{id}', 'HomeController@editSetor')->name('setor-edit');
	Route::post('/setorr/update', 'HomeController@updateSetorr')->name('setorr-update');
	Route::post('/setor/update', 'HomeController@updateSetor')->name('setor-update');
	Route::get('/delete-setor/{id}', 'HomeController@deleteSetor')->name('delete-setor');
	Route::get('/users/lihat/delete-setoruser/{id}', 'HomeController@deleteSetorUser')->name('delete-setoruser');
	Route::post('/users/lihat/update', 'HomeController@updatePendapatan')->name('pendapatan-update');
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

	Route::get('/tentang-kami', 'HomeController@tentangKami')->name('tentang-kami');
	Route::post('/set-setoran', 'HomeController@setSetoran')->name('set-setoran');
	Route::post('/approve', 'HomeController@Approve')->name('approve');
	Route::get('/withdrawal', 'HomeController@Withdrawall')->name('withdrawal');
	Route::post('/set-witdraw', 'HomeController@Withdrawal')->name('set-withdrawal');

	Route::get('/ubah-password', 'HomeController@UbahPassword')->name('ubah-password');


	Route::get('/mail', 'PhpmailerController@Mail')->name('mail');
	Route::post('/send-mail', 'PhpmailerController@sendMail')->name('send-mail');
});

