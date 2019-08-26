<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('user/id', 'User@create');
Route::get('user/list', 'User@list');
Route::get('user/detail', 'User@detail');

Route::post('person', 'Person@create');
Route::post('token', 'Token@getToken');
Route::get('person', 'Person@info');
Route::post('logout', 'Token@logout');

Route::post('person/test', 'Person@test');
Route::put('person/tests', 'Person@tests');

Route::fallback(function () {
    throw new \App\Exceptions\MissException();
});