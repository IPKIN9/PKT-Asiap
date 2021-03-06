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

Route::prefix('landing')->group(function () {
    Route::get('index', 'LandingController@index')->name('landing');
    Route::get('search/{id}', 'LandingController@search_resi');
});


//Login & Register
Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', 'DashboardController@index')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');
    Route::patch('update/{id}', 'DashboardController@update');

    Route::prefix('Pengirim/')->group(function () {
        Route::get('show/', 'PengirimController@index')->name('pengirim.index');
        Route::post('inserting/', 'PengirimController@insert')->name('pengirim.insert');
        Route::get('edit/{id}', 'PengirimController@edit_data')->name('pengirim.edit');
        Route::patch('update/{id}', 'PengirimController@update')->name('pengirim.update');
        Route::delete('delete/{id}', 'PengirimController@destroy')->name('pengirim.destroy');
    });
    Route::prefix('Lokasi/')->group(function () {
        Route::get('show/', 'LokasiController@index')->name('lokasi.index');
        Route::post('inserting/', 'LokasiController@insert')->name('lokasi.insert');
        Route::get('edit/{id}', 'LokasiController@edit_data')->name('lokasi.edit');
        Route::patch('update/{id}', 'LokasiController@update')->name('lokasi.update');
        Route::delete('delete/{id}', 'LokasiController@destroy')->name('lokasi.destroy');
    });

    Route::prefix('Supir/')->group(function () {
        Route::get('show/', 'SupirController@index')->name('supir.index');
        Route::post('inserting/', 'SupirController@insert')->name('supir.insert');
        Route::get('edit/{id}', 'SupirController@edit_data')->name('supir.edit');
        Route::patch('update/{id}', 'SupirController@update')->name('supir.update');
        Route::delete('delete/{id}', 'SupirController@destroy')->name('supir.destroy');
    });
    Route::prefix('Mobil/')->group(function () {
        Route::get('show/', 'MobilController@index')->name('mobil.index');
        Route::post('inserting/', 'MobilController@insert')->name('mobil.insert');
        Route::get('edit/{id}', 'MobilController@edit_data')->name('mobil.edit');
        Route::patch('update/{id}', 'MobilController@update')->name('mobil.update');
        Route::delete('delete/{id}', 'MobilController@destroy')->name('mobil.destroy');
    });
    Route::prefix('Pesan/')->group(function () {
        Route::get('show/', 'PesanController@index')->name('pesan.index');
        Route::post('inserting/', 'PesanController@insert')->name('pesan.insert');
        Route::get('edit/{id}', 'PesanController@edit_data')->name('pesan.edit');
        Route::patch('update/{id}', 'PesanController@update')->name('pesan.update');
        Route::delete('delete/{id}', 'PesanController@destroy')->name('pesan.destroy');
    });
    Route::prefix('Kirim/')->group(function () {
        Route::get('show/', 'ProsesController@index')->name('kirim.index');
        Route::post('inserting/', 'ProsesController@insert')->name('kirim.insert');
        Route::get('edit/{id}', 'ProsesController@edit_data')->name('kirim.edit');
        Route::patch('update/{id}', 'ProsesController@update')->name('kirim.update');
        Route::delete('delete/{id}', 'ProsesController@destroy')->name('kirim.destroy');
    });
    Route::prefix('status/')->group(function () {
        Route::get('show/', 'StatusPengirimanController@index')->name('status.index');
        Route::post('inserting/', 'StatusPengirimanController@insert')->name('status.insert');
        Route::get('edit/{id}', 'StatusPengirimanController@edit_data')->name('status.edit');
        Route::patch('update/{id}', 'StatusPengirimanController@update')->name('status.update');
        Route::delete('delete/{id}', 'StatusPengirimanController@destroy')->name('status.destroy');
    });
    Route::prefix('super/')->group(function () {
        Route::get('show/', 'SuperAdminController@index')->name('super.index');
        Route::post('inserting/', 'SuperAdminController@insert')->name('super.insert');
        Route::get('edit/{id}', 'SuperAdminController@edit_data')->name('super.edit');
        Route::patch('update/{id}', 'SuperAdminController@update')->name('super.update');
        Route::delete('delete/{id}', 'SuperAdminController@destroy')->name('super.destroy');
    });
});
