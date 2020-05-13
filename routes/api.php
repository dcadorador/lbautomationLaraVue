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

});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
