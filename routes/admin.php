<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['guest:api'], 'namespace' => 'Admin'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['assign.guard:admin'], 'namespace' => 'Admin'], function () {

    /* User */
    Route::get('me', 'MeController@index');
    Route::get('user', 'MeController@index');

    /* Home */
    Route::get('/home', 'HomeController@index');

    /* Users */
    Route::get('users/all', 'UserController@getAll');
    Route::resource('users', 'UserController');

    /* Examinations */
    Route::get('examinations/all', 'ExaminationController@getAll');
    Route::resource('examinations', 'ExaminationController');

    /* Service Provider Types */
    Route::get('service-provider-types/all', 'ServiceProviderTypeController@getAll');
    Route::resource('service-provider-types', 'ServiceProviderTypeController');

    /* Service Providers */
    Route::resource('service-providers', 'ServiceProviderController');
    Route::get('service-providers/search', 'ServiceProviderController@search');

    /* Orders */
    Route::resource('orders', 'OrderController');
    Route::get('order-statuses', 'OrderController@getOrderStatuses');

    /* Services */
    Route::get('services/all', 'ServiceController@getAll');
    Route::resource('services', 'ServiceController');

    Route::post('fcm', 'NotificationController@sendFCMNotification');

    /* Attachments */
    Route::get('attachments/{attachment}', 'OrderController@getAttachment');

});
