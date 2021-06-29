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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Pengirim
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

//Mobil
Route::prefix('Mobil/')->group(function () {
    Route::get('show/', 'MobilController@index')->name('mobil.index');
    Route::post('inserting/', 'MobilController@insert')->name('mobil.insert');
    Route::get('edit/{id}', 'MobilController@edit_data')->name('mobil.edit');
    Route::patch('update/{id}', 'MobilController@update')->name('mobil.update');
    Route::delete('delete/{id}', 'MobilController@destroy')->name('mobil.destroy');
});
