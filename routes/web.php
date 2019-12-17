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
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/dashboard', function () {
        return view('MyHome');
    })->name('home.index');

    Route::group(['prefix' => 'atribut'], function () {
        Route::get('/', 'AtributController@index')->name('atribut.index');
        Route::post('/store', 'AtributController@store')->name('atribut.store');
        Route::post('/nilai/store', 'AtributController@nilaistore')->name('nilai.store');
        Route::put('/{id}/update', 'AtributController@update')->name('atribut.update');
        Route::get('/{id}/delete', 'AtributController@destroy')->name('atribut.delete');
        Route::get('/nilai/{id}/delete', 'AtributController@nilaidestroy')->name('nilai.delete');
    });

    Route::group(['prefix' => 'dataset'], function () {
        Route::get('/', 'DatasetController@index')->name('dataset.index');
        Route::post('/store', 'DatasetController@store')->name('dataset.store');
        Route::put('/{id}/update', 'DatasetController@update')->name('dataset.update');
        Route::get('/{id}/delete', 'DatasetController@destroy')->name('dataset.delete');
        Route::post('/import', 'DatasetController@import')->name('import.excel');
    });

    Route::group(['prefix' => 'hitung'], function () {
        Route::get('/', 'HitungController@index')->name('hitung.index');
        Route::post('/hasil', 'HitungController@hasil')->name('hasil.index');
    });

});
