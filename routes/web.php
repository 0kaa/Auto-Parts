<?php

use Illuminate\Support\Facades\Route;

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

Route::get('lang/{locale}', [\App\Http\Controllers\Admin\HomeController::class, 'lang'])->name('lang');

Route::middleware(['guest'])->group(function () {
    // Auth Routes

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('show-login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
});


// Dashboard routes
Route::middleware(['admin', 'Localization'])->name('admin.')->group(function () {

    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    Route::resource('static-pages', 'StaticPageController');
    Route::resource('settings', 'SettingController');

    Route::resource('users', 'UserController');

    Route::resource('activities-types', 'ActivityTypeController');

    Route::resource('regions', 'RegionController');

    Route::resource('cars', 'CarController');

    Route::resource('packages', 'PackageController');

    Route::resource('cities', 'CityController');

    Route::resource('shippings', 'ShippingController');

    Route::resource('company-sectors', 'CompanySectorController');

    Route::resource('sliders-services', 'SliderServiceController');

    Route::resource('news-letter', 'NewsLetterController');

    Route::resource('faqs', 'FaqsController');

    Route::resource('orders', 'OrderController');

    Route::resource('custom_orders', 'CustomOrderController');

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});
