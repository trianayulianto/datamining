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
        Route::get('/', 'AtributController@index')->name('dataser.index');
        Route::post('/store', 'AtributController@store')->name('dataser.store');
        Route::put('/{id}/update', 'AtributController@update')->name('dataser.update');
        Route::get('/{id}/delete', 'AtributController@destroy')->name('dataser.delete');
    });

    Route::get('/test', 'TestController@index');

});
