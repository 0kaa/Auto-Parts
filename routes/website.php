<?php

//website not aut and guest
Route::name('website.')->middleware('Localization')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('static-page/{slug}', 'HomeController@staticPage')->name('static-page');
    Route::get('register-now', 'UserController@register')->name('register-now');
    Route::post('subscribe', 'HomeController@subscribe')->name('subscribe');
    Route::get('contact-us', 'HomeController@contactUs')->name('contact-us');
    Route::post('send-contact-us', 'HomeController@sendContactUs')->name('send-contact-us');
    Route::post('register', 'UserController@registerStore')->name('register');
    Route::post('active', 'UserController@activeStore')->name('active');
    Route::get('get/activity/types', 'UserController@getActivitiesType')->name('get.activity.types');
    Route::post('company', 'UserController@companyStore')->name('company');
    Route::get('click/plus/branches', 'UserController@getBranches')->name('click.plus.branches');
    Route::get('resend/code', 'UserController@resendCode')->name('resend.code');

});