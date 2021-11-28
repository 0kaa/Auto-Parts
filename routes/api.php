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
    Route::post('login', 'ApiAuthController@login');
    Route::post('register', 'ApiAuthController@register');
});


Route::namespace('Api')->middleware('lang')->group(function () {

    Route::get('activities',            'ApiActivitiesController@index');
    // sub activities
    Route::get('activity/{id}',         'ApiActivitiesController@show');
    Route::get('activity/{id}/sub',     'ApiActivitiesController@getSubActivities');
    Route::get('stores',                'ApiStoreController@getStoresList');
    Route::get('product/{id}',          'ApiProductController@show');
    Route::get('products/store/{id}',   'ApiProductController@getStoreProducts');

    Route::get('static-page/{slug}',    'ApiStaticPagesController@getStaticPage');
    Route::get('faqs',                  'ApiFaqsController@index');
    Route::get('cars',                  'ApiCarController@index');
    Route::post('contactus',            'ApiContactUsController@create');
    Route::get('shippings',             'ApiShippingController@index');

    // All users but authenticated required
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::put('change-password',              'ApiAccountController@change_password');
        Route::get('notifications',                'ApiNotificationsController@index');
    });

    // User | workshop authenticated required
    Route::group(['middleware' => ['auth:sanctum', 'role:user|workshop']], function () {
        Route::post('custom-order/create',              'ApiCustomOrderController@CreateCustomOrder');
        Route::get('user-custom-order/{id}',            'ApiCustomOrderController@getCustomOrder');
        Route::post('user-custom-order/{id}/accept',    'ApiCustomOrderController@userAcceptedOrders');
        Route::post('user-custom-order/{id}/reject',    'ApiCustomOrderController@userRejectedOrders');
        // Price offers
        Route::get('price-offers',                      'ApiPriceOfferController@index');
        

        // Route::get('price-offers',                      'ApiCustomOrderController@getPriceOffers');
        Route::post('rating/product/{id}',              'ApiRatingController@createProductRating');
        Route::post('rating/store/{id}',                'ApiRatingController@createStoreRating');
        Route::get('my-favourites',                     'ApiFavourtiesController@index');
        Route::post('product/favourties/create/{id}',   'ApiFavourtiesController@createProductFavourtie');
        Route::post('store/favourties/create/{id}',     'ApiFavourtiesController@createStoreFavourtie');
        Route::post('new-order',                        'ApiOrderController@CreateOrder');
        Route::get('search',                            'ApiSearchController@search');
    });

    // User | Store | workshop authenticated required
    Route::group(['middleware' => ['auth:sanctum', 'role:owner_store|user|workshop']], function () {
        Route::resource('my-account',                   'ApiAccountController');
        Route::get('my-orders',                         'ApiOrderController@myOrders');
        Route::get('order/{id}',                        'ApiOrderController@getOrder');
        Route::get('custom-order/{id}',                 'ApiCustomOrderController@getOrder');
    });


    // Owner Store authenticated required
    Route::group(['middleware' => ['auth:sanctum', 'role:owner_store']], function () {
        Route::resource('my-company',                   'ApiCompanyController');
        Route::resource('my-branches',                  'ApiBranchesController');
        Route::post('package-subscription/create',      'ApiPackagesController@createSubscription');
        Route::get('packages',                          'ApiPackagesController@index');
        Route::post('product/create',                   'ApiProductController@create');
        Route::post('product/update/{id}',              'ApiProductController@update');
        Route::delete('product/delete/{id}',            'ApiProductController@delete');
        Route::put('order/update-status',               'ApiOrderController@updateOrderStatus');
        Route::post('my-orders/search',                 'ApiOrderController@searchOrders');
        Route::get('seller-custom-orders',              'ApiCustomOrderController@getSellerOrders');
        Route::post('seller-custom-order/{id}/accept',  'ApiCustomOrderController@sellerAcceptedOrder');
        Route::post('seller-custom-order/{id}/reject',  'ApiCustomOrderController@sellerRejectedOrder');
        Route::post('price-offer/create',               'ApiPriceOfferController@create');
        Route::get('price-offer/{id}',                  'ApiPriceOfferController@show');
        Route::get('price-offer/{id}/accept',           'ApiPriceOfferController@accept');
        Route::get('price-offer/{id}/reject',           'ApiPriceOfferController@reject');
    });
});
