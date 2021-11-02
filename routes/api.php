<?php

use Illuminate\Http\Request;
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

Route::namespace('Api\Auth')->group(function () {

    // Authentication Routes -> [Login , Register]
    Route::post('login', 'ApiAuthController@login');
    Route::post('register', 'ApiAuthController@register');

    // Auth Middleware -> [ Loggedin ]
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('get_user', 'ApiAuthController@get_user'); // Get User Data By token        

    });
});


Route::namespace('Api')->group(function () {

    Route::get('activites','ApiActivitesController@index');
    Route::get('activitiy/{id}','ApiActivitesController@show');

});
