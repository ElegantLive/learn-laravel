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

Route::post('person/test', 'Person@tests');
Route::post('person', 'Person@test');

Route::fallback(function () {
    throw new \App\Exceptions\MissException();
});