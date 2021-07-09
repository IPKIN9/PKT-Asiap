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



//Login & Register
Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['middleware' => 'auth'], function () {
 
    Route::get('home', 'DashboardController@index')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');
 
});

// Pengirim
Route::prefix('Pengirim/')->group(function () {
    Route::get('show/', 'PengirimController@index')->name('pengirim.index');
    Route::post('inserting/', 'PengirimController@insert')->name('pengirim.insert');
    Route::get('edit/{id}', 'PengirimController@edit_data')->name('pengirim.edit');
    Route::patch('update/{id}', 'PengirimController@update')->name('pengirim.update');
    Route::delete('delete/{id}', 'PengirimController@destroy')->name('pengirim.destroy');
});

//Mobil
Route::prefix('Mobil/')->group(function () {
    Route::get('show/', 'MobilController@index')->name('mobil.index');
    Route::post('inserting/', 'MobilController@insert')->name('mobil.insert');
    Route::get('edit/{id}', 'MobilController@edit_data')->name('mobil.edit');
    Route::patch('update/{id}', 'MobilController@update')->name('mobil.update');
    Route::delete('delete/{id}', 'MobilController@destroy')->name('mobil.destroy');
});