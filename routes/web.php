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

Route::get('/{any?}', 'HomeController')
    ->where('any','^(?!api\/)[\/\w\.-]*');

/*Route::get('/{any?}', 'HomeController')
    ->where('infusionsoft','^(?!api\/)[\/\w\.-]*');*/
