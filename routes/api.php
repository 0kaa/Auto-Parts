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


Route::namespace('Api')->middleware('lang')->group(function () {

    Route::get('activities',            'ApiActivitiesController@index');
    Route::get('activity/{id}',         'ApiActivitiesController@show');
    Route::get('products/store/{id}',   'ApiProductController@getStoreProducts');
    Route::get('product/{id}',          'ApiProductController@show');
    Route::get('ratings/product/{id}',  'ApiProductController@getProductRatings');
    Route::get('stores',                'ApiStoreController@getStoresList');
    Route::get('static-page/{slug}',    'ApiStaticPages@getStaticPage');
    Route::get('faqs',                  'ApiFaqsController@index');
    Route::post('contactus',            'ApiContactUs@create');


    // Auth Required
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::put('/change-password',              'ApiAccountController@change_password');
        // Notifications
        Route::get('notifications',                 'ApiNotificationsController@index');
    });


    // User
    Route::group(['middleware' => ['auth:sanctum', 'role:user']], function () {
        Route::post('rating/product/{id}',              'ApiRatingController@createProductRating');
        Route::post('rating/store/{id}',                'ApiRatingController@createStoreRating');
        Route::get('my-favourites',                     'ApiFavourtiesController@index');
        Route::post('product/favourties/create/{id}',   'ApiFavourtiesController@createProductFavourtie');
        Route::post('store/favourties/create/{id}',     'ApiFavourtiesController@createStoreFavourtie');
        Route::post('new-order',                        'ApiOrderController@CreateOrder');
        Route::get('search',                            'ApiSearchController@search');
    });

    // User | Store Account data
    Route::group(['middleware' => ['auth:sanctum', 'role:owner_store|user']], function () {
        Route::resource('/my-account',                  'ApiAccountController');
        Route::get('my-orders',                         'ApiOrderController@myOrders');
    });


    // Owner Store
    Route::group(['middleware' => ['auth:sanctum', 'role:owner_store']], function () {
        Route::post('product/create',                   'ApiProductController@create');
        Route::resource('/my-company',                  'ApiCompanyController');
        Route::resource('/my-branches',                 'ApiBranchesController');
        Route::put('order/update-status',               'ApiOrderController@updateOrderStatus');
        Route::get('my-orders/filter',                  'ApiOrderController@filterOrders');

        // get order by id
        Route::get('order/{id}',                         'ApiOrderController@getOrder');
    });
});
