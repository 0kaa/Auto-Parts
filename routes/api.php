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

Route::namespace('Api\Auth')->middleware('lang')->group(function () {
    Route::post('login',                                'ApiAuthController@login');
    Route::post('register',                             'ApiAuthController@register');
    Route::post('verify-code',                          'ApiAuthController@verifyCode');
    Route::post('reset-password',                       'ApiAuthController@resetPassword');
    Route::post('reset-password/verify-code',           'ApiAuthController@verifyCodeNewPassword');
    Route::post('reset-password/new-password',          'ApiAuthController@newPassword')->middleware('auth:sanctum');
});

Route::namespace('Api')->group(function () {
    Route::get('charge-order-redirect',                 'ApiPaymentController@charge_order');
    Route::get('charge-custom-order-redirect',          'ApiPaymentController@charge_custom_order');
});

Route::namespace('Api')->middleware('lang')->group(function () {
    Route::get('activities',                            'ApiActivitiesController@index');
    // sub activities
    Route::get('activity/{id}',                         'ApiActivitiesController@show');
    Route::get('activity/{id}/sub',                     'ApiActivitiesController@getSubActivities');
    Route::get('sub/activity/{id}/sub',                 'ApiActivitiesController@getSubSubActivities');
    Route::get('stores',                                'ApiStoreController@getStoresList');
    Route::get('store/{id}',                            'ApiStoreController@getStore');
    Route::get('product/{id}',                          'ApiProductController@show');
    Route::get('products/store/{id}',                   'ApiProductController@getStoreProducts');
    Route::get('cars',                                  'ApiAccountController@companiesSector');
    Route::get('model/car/{id}',                        'ApiAccountController@getModelCar');
    Route::get('companies-sector',                      'ApiAccountController@companiesSector');
    Route::get('cities',                                'ApiCityController@index');
    Route::get('regions',                               'ApiRegionController@index');
    Route::post('contactus',                            'ApiContactUsController@create');
    Route::get('shippings',                             'ApiShippingController@index');
});


Route::namespace('Api')->middleware('lang')->group(function () {


    Route::get('static-page/{slug}',    'ApiStaticPagesController@getStaticPage');
    Route::get('faqs',                  'ApiFaqsController@index');


    // All users | authenticated required
    Route::group(['middleware' => ['auth:sanctum']], function () {


        Route::post('change-password',                  'ApiAccountController@change_password');
        Route::get('notifications',                     'ApiNotificationsController@index');
        Route::get('my-account',                        'ApiAccountController@index');
        Route::post('my-account/update',                'ApiAccountController@update');
        Route::post('notifications/toggle',             'ApiAccountController@toggleNotifications');
        Route::get('my-orders',                         'ApiOrderController@myOrders');
        Route::get('order/{id}',                        'ApiOrderController@getOrder');
        Route::get('order_status',                      'ApiOrderController@orderStatus');
        Route::get('order_status/seller',               'ApiOrderController@orderSellerStatus');
        Route::get('order_status/stepper',              'ApiOrderController@orderStepper');
        Route::get('custom-order/{id}',                 'ApiCustomOrderController@getOrder');
        Route::get('payment_methods',                   'ApiPaymentController@payment_methods');
    });

    // User | workshop authenticated required
    Route::group(['middleware' => ['auth:sanctum', 'role:user|workshop']], function () {
        Route::get('sub/{id}/attributes',               'ApiAttributeController@getSubAttributes');
        Route::post('custom-order/create',              'ApiCustomOrderController@CreateCustomOrder');
        Route::post('custom-order/create-multi',        'ApiCustomOrderController@CreateMultiCustomOrder');
        Route::get('user-custom-order/{id}',            'ApiCustomOrderController@getCustomOrder');
        Route::post('price-offer/{id}/accept',          'ApiCustomOrderController@AcceptPriceOffer');
        Route::post('price-offer/{id}/reject',          'ApiCustomOrderController@RejectPriceOffer');
        Route::get('price-offers/order/{id}',           'ApiCustomOrderController@PriceOffers');
        Route::get('my-custom-orders',                  'ApiCustomOrderController@userOrders');
        Route::post('rating/product/{id}',              'ApiRatingController@createProductRating');
        Route::post('rating/store/{id}',                'ApiRatingController@createStoreRating');
        Route::get('my-favourites',                     'ApiFavourtiesController@index');
        Route::post('product/favourties/create/{id}',   'ApiFavourtiesController@createProductFavourtie');
        Route::post('store/favourties/create/{id}',     'ApiFavourtiesController@createStoreFavourtie');
        Route::post('new-order',                        'ApiOrderController@CreateOrder');
        Route::get('cart',                              'ApiCartController@getMyCart');
        Route::post('cart/create',                      'ApiCartController@addToCart');
        Route::post('cart/remove',                      'ApiCartController@removeFromCart');
        Route::post('cart/change-quantity',             'ApiCartController@changeQuantity');
    });

    Route::group(['middleware' => ['auth:sanctum', 'role:user|workshop|owner_store']], function () {
        Route::post('search',                           'ApiSearchController@search');
    });

    // Owner Store authenticated required
    Route::group(['middleware' => ['auth:sanctum', 'role:owner_store']], function () {
        Route::get('stores/activity/{id}',              'ApiStoreController@getStoresInMyActivity');
        Route::get('my-company',                        'ApiCompanyController@index');
        Route::post('my-company/update',                'ApiCompanyController@update');
        Route::get('my-branches',                       'ApiBranchesController@index');
        Route::post('my-branches/update',               'ApiBranchesController@update');
        Route::post('package-subscription/create',      'ApiPackagesController@createSubscription');
        Route::get('packages',                          'ApiPackagesController@index');
        Route::post('product/create',                   'ApiProductController@create');
        Route::post('product/update/{id}',              'ApiProductController@update');
        Route::delete('product/delete/{id}',            'ApiProductController@delete');
        Route::post('order/update-status',               'ApiOrderController@updateOrderStatus');
        Route::post('my-orders/search',                 'ApiOrderController@searchOrders');

        // current orders
        Route::get('my-orders/current',                 'ApiOrderController@currentOrders');
        Route::post('seller-custom-order/{id}/accept',  'ApiCustomOrderController@sellerAcceptedOrder');
        Route::post('seller-custom-order/{id}/reject',  'ApiCustomOrderController@sellerRejectedOrder');
        Route::post('price-offer/create',               'ApiPriceOfferController@create');
        Route::get('wallet-request',                   'ApiWalletRequestController@createWalletRequest');
    });
});
