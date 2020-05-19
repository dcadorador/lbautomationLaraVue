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
Route::group([
    'namespace' => 'Api',
    'middleware' => 'api',
    'as' => 'api',
    'prefix' => 'v1'
], function () {

    Route::post('login', [
        'as' => '.login',
        'uses' => 'AuthController@login'
    ]);

    Route::post('register', [
        'as' => '.register',
        'uses' => 'AuthController@register'
    ]);

    Route::post('logout', [
        'as' => '.logout',
        'uses' => 'AuthController@logout'
    ]);


    Route::group([
        'prefix' => 'users',
        'as' => '.users'
    ], function() {

        Route::get('', [
            'as' => '.user-collection',
            'uses' => 'UserController@collection'
        ]);

        Route::post('', [
            'as' => '.user-create',
            'uses' => 'UserController@create'
        ]);

        Route::get('{id}', [
            'as' => '.user-find',
            'uses' => 'UserController@get'
        ]);

        Route::put('{id}', [
            'as' => '.user-update',
            'uses' => 'UserController@update'
        ]);

        Route::delete('{id}', [
            'as' => '.user-delete',
            'uses' => 'UserController@delete'
        ]);

    });

});

