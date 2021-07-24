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

Route::get('password',function(){
    return bcrypt('dharos');
});

Route::get('/siswa', 'API\SiswaController@index');
Route::get('/siswa/{siswa}', 'API\SiswaController@show');
Route::delete('/siswa/{siswa}', 'API\SiswaController@destroy');
Route::post('/siswa/', 'API\SiswaController@store');
Route::patch('/siswa/{siswa}', 'API\SiswaController@update');

Route::get('/mapel', 'API\MapelController@index');
Route::get('/mapel/{mapel}', 'API\MapelController@show');
Route::delete('/mapel/{mapel}', 'API\MapelController@destroy');
Route::post('/mapel/', 'API\MapelController@store');
Route::patch('/mapel/{mapel}', 'API\MapelController@update');

Route::get('/nilai', 'API\NilaiController@index');
Route::get('/nilai/{nilai}', 'API\NilaiController@show');
Route::delete('/nilai/{nilai}', 'API\NilaiController@destroy');
Route::post('/nilai/', 'API\NilaiController@store');
Route::patch('/nilai/{nilai}', 'API\NilaiController@update');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});