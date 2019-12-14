<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAtributById', function (Request $request) {
    return response(\App\Atribut::find($request->id));
})->name('atribut.json.id');

Route::get('/getAtribut', function () {
    $data['atribut'] = \App\Atribut::all();
    foreach ($data['atribut'] as $key => $value) {
        $data['atribut'][$key]->nilai;
    }
    return response($data['atribut']);
})->name('atribut.json.all');

Route::get('/getDatasetById', function (Request $request) {
    return response(\App\Dataset::find($request->id));
})->name('dataset.json.id');

Route::post('/dataset/strore', 'DatasetController@store');
