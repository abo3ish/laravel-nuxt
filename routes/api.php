<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/admin.php';


Route::group(['middleware' => 'assign.guard:api'], function () {

    Route::get('/me', 'Api\MeController@index');
    Route::get('user', 'Api\MeController@index');

    Route::post('logout', 'Api\AuthController@logout');

    Route::patch('settings/profile', 'Settings\ProfileController@update');

    Route::patch('settings/password', 'Settings\PasswordController@update');

    // Examination services
    Route::get('/examination-services', 'Api\ExaminationServiceController@index');

    // Examination services Types
    Route::get('examination-service-types/{examinationServiceType}', 'Api\ExaminationServiceTypeController@show');

    // Cart
    Route::resource('cart', 'Api\CartController');

    // Address
    Route::resource('addresses', 'Api\AddressController');

    // Examination Order
    Route::resource('orders', 'Api\OrderController');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
