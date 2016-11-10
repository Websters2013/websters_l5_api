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


Route::group(['prefix' => 'v1', 'middleware' => ['cors','google.check']], function () {
    
    Route::resource('users','UserController', ['only' => ['store','show','destroy','update']]);
    
    Route::post('users/create','UserController@create');
    
    Route::get('roles','RoleController@getRoles');
    
    Route::resource('positions','PositionController', ['only' => ['store','show','destroy','update']]);
    
});

Route::group(['prefix' => 'v1', 'middleware' => ['cors','google.auth']], function () {

    Route::post('/auth',['uses' => 'AuthController@getLogin', 'as' => 'auth'])->middleware('google.auth');
    
});


Route::group(['prefix' => 'v1'], function () {

    Route::get('test/{id}','UserController@getTest');

});

