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
    return view('login');
});

// users 
Route::get('dashboard-show-login', 'UsersController@index')->name('login');
Route::post('dashboard-login', 'UsersController@login')->name('users_login');
Route::get('logout', 'UsersController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard-home', 'DashboardController@index')->name('dashboard.index');
    Route::resource('dashboard-obat', 'ObatController');
    Route::get('dashboard-obat-get/{id}', 'ObatController@get_obat')->name('get_obat');
    Route::resource('dashboard-category', 'CategoryController');
    Route::resource('dashboard-transaction', 'TransactionController');
    Route::resource('pemesanan', 'PemesananController');
    Route::resource('satuan','SatuanController');
});
