<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/admin.php';

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('login/social', 'Api\AuthController@socialLogin');
    Route::post('register', 'Api\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});


Route::group(['middleware' => 'assign.guard:api', 'namespace' => 'Api'], function () {

    Route::get('/me', 'MeController@index');
    Route::get('user', 'MeController@index');
    Route::post('logout', 'AuthController@logout');


    // Examinations
    Route::get('/examinations', 'ExaminationController@index');

    // Examination services Types
    Route::get('examination-service-types/{examinationServiceType}', 'ExaminationServiceTypeController@show');

    // Cart
    Route::resource('cart', 'CartController');

    // Address
    Route::resource('addresses', 'AddressController');
    Route::get('areas', 'AreaController@index');

    // Examination Order
    Route::resource('orders', 'OrderController');


    /*
        Pharmacy
    */
    Route::resource('pharmacy-categories', 'PharmacyCategoryController');
    Route::post('cart/checkout', 'CartController@checkout');
});


