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

Route::post('login', 'MembersController@login');
Route::post('register', 'MembersController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('member', 'MembersController@member');
    Route::get('update', 'MembersController@update');
    Route::get('sessions', 'MembersController@sessions');
    Route::get('attendance', 'MembersController@attendance');
    Route::get('attend', 'ProductController@attend');
});
