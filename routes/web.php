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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('packages/get-json-data', 'PackagesController@getJsonData');
    Route::get('cities/get-json-data', 'CityController@getJsonData');
    Route::resource('packages', 'PackagesController');
    Route::resource('cities', 'CityController');
});

Route::group(['middleware' => ['role:admin|city_manager']], function () {
    Route::get('gym-managers/get-json-data', 'UsersController@getJsonData');
    Route::resource('gym-managers', 'UsersController', ['parameters' => [
    'gym-managers' => 'user'
]]);
});


Route::group(['middleware' => ['role:admin|city_manager|gym_manager']], function () {
    Route::get('coaches/get-json-data', 'CoachesController@getJsonData');
    Route::get('sessions/get-json-data', 'SessionsController@getJsonData');
    Route::get('gyms/get-json-data', 'GymsController@getJsonData');
    
    Route::resource('sessions', 'SessionsController');
    Route::resource('payments', 'PaymentController');
    Route::resource('coaches', 'CoachesController');
    Route::resource('gyms', 'GymsController');
});
