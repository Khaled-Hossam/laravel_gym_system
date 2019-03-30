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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('packages/get-json-data', 'PackagesController@getJsonData');
        Route::get('cities/get-json-data', 'CityController@getJsonData');
        Route::resource('packages', 'PackagesController');
        Route::resource('cities', 'CityController');

        Route::get('city-managers/get-json-data', 'CityManagersController@getJsonData');
        Route::resource('city-managers', 'CityManagersController', ['parameters' => [
            'city-managers' => 'user'
        ]]);

        Route::get('members/get-json-data', 'MembersCrudController@getJsonData');
        Route::resource('members', 'MembersCrudController');
    });

    Route::group(['middleware' => ['role:admin|city_manager']], function () {
        Route::get('gym-managers/get-json-data', 'GymManagersController@getJsonData');
        Route::get('gym-managers/{user}/ban', 'GymManagersController@banUser');
        Route::resource('gym-managers', 'GymManagersController', ['parameters' => [
            'gym-managers' => 'user'
        ]]);

        Route::get('gyms/get-json-data', 'GymsController@getJsonData');
        Route::resource('gyms', 'GymsController');
    });



    Route::get('membersForPayments/get-json-data', 'PaymentController@getJsonData');
    Route::get('membersForPayments/{member}', 'PaymentController@buy');
    Route::post('paymentContinue/{member}', 'PaymentController@continue');
    Route::resource('payments', 'PaymentController');
    
    Route::get('revenues/get-json-data', 'PackagePurshaseController@getJsonData');
    Route::resource('revenues', 'PackagePurshaseController');


        
    Route::group(['middleware' => ['role:admin|city_manager|gym_manager']], function () {
        Route::get('attendances/get-json-data', 'AttendancesController@getJsonData');
        Route::get('attendances', 'AttendancesController@index')->name('attendances.index');
        
        Route::get('coaches/get-json-data', 'CoachesController@getJsonData');
        Route::get('sessions/get-json-data', 'SessionsController@getJsonData');
        Route::resource('sessions', 'SessionsController');
        Route::resource('payments', 'PaymentController');
        Route::resource('coaches', 'CoachesController');
        Route::resource('revenues', 'PackagePurshaseController');
    });
});