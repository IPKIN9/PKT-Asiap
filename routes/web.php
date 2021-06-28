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
