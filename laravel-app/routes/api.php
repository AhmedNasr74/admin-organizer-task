<?php

use Illuminate\Support\Facades\Route;

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

//admin
Route::group(['prefix' => 'admin', 'namespace' =>'Admin'], function() {

    Route::post('auth/login', 'AuthController@login');


    //authenticated routes protected by organizer guard
    Route::group(['middleware' => 'auth:api'] , function () {

        Route::group(['prefix' => 'events' ] , function () {
            Route::get('/' , 'EventController@index');
            Route::get('/show/{id}' , 'EventController@show');
            Route::post('/change-status/{id}' , 'EventController@change_status');
        });

    });

});

//organizer
Route::group(['prefix' => 'organizer', 'namespace' =>'Organizer'], function() {
    Route::group(['prefix' => 'auth'], function() {

        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');

    });

    //authenticated routes protected by organizer guard
    Route::group(['middleware' => 'auth:organizers'] , function () {

        Route::group(['prefix' => 'events' ] , function () {
            Route::get('/' , 'EventController@index');
            Route::get('/show/{id}' , 'EventController@show');
            Route::post('/update/{id}' , 'EventController@update');
            Route::post('/store' , 'EventController@store');
        });
    });
});



