<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/admin.php';

Route::group(['namespace' => 'Api'], function () {
    Route::get('splash-ad', 'AdvertisementController@showSplashAd');

    Route::post('login', 'AuthController@login');
    Route::post('login/social', 'AuthController@socialLogin');
    // Route::post('register', 'RegisterController@register');
    Route::get('test/fcm/{token}', 'AuthController@testFcm');

    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend');

    // Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    // Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

    // All Areas
    Route::get('areas', 'AreaController@index');

    /*
        Examinations
    */
    Route::get('/examinations', 'ExaminationController@index');

    /*
        Pharmacy
    */
    Route::get('pharmacy-categories/{pharmacyCategory}/sub', 'PharmacyCategoryController@subCategories');
    Route::resource('pharmacy-categories', 'PharmacyCategoryController');
    Route::get('drugs', 'DrugController@index');
});


Route::group(['middleware' => 'assign.guard:api', 'namespace' => 'Api'], function () {

    Route::get('/me', 'MeController@index');
    Route::get('user', 'MeController@index');
    Route::post('logout', 'AuthController@logout');



    // Examination services Types
    Route::get('examination-service-types/{examinationServiceType}', 'ExaminationServiceTypeController@show');

    // Cart
    // Route::resource('cart', 'CartController');

    // Address
    Route::resource('addresses', 'AddressController');

    // Examination Order
    Route::post('reorder/{order}', 'OrderController@reorder');
    Route::resource('orders', 'OrderController');



    Route::post('cart/checkout', 'CartController@checkout');
});


