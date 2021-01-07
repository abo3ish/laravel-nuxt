<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['guest:api'], 'namespace' => 'Admin'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'namespace' => 'Admin'], function () {

    /* User */
    Route::get('me', 'MeController@index');
    Route::get('user', 'MeController@index');
    Route::post('logout', 'AuthController@logout');

    /* Home */
    Route::get('/home', 'HomeController@index');

    /* Users */
    Route::get('users/all', 'UserController@getAll');
    Route::post('users/{user}', 'UserController@update');
    Route::resource('users', 'UserController');

    /* Examinations */
    Route::get('examinations/all', 'ExaminationController@getAll');
    Route::post('examinations/{examination}', 'ExaminationController@update');
    Route::resource('examinations', 'ExaminationController');

    /* Service Provider Types */
    Route::get('service-provider-types/all', 'ServiceProviderTypeController@getAll');
    Route::post('service-provider-types/{serviceProviderType}', 'ServiceProviderTypeController@update');
    Route::resource('service-provider-types', 'ServiceProviderTypeController');

    /* Service Providers */
    Route::post('service-providers/{serviceProvider}', 'ServiceProviderController@update');
    Route::resource('service-providers', 'ServiceProviderController');

    /* Orders */
    Route::post('orders/{Order}', 'OrderController@update');
    Route::resource('orders', 'OrderController');
    Route::get('order-statuses', 'OrderController@getOrderStatuses');

    /* Drug Order */
    Route::post('drug-order/{drugOrder}', 'DrugOrderController@update');
    Route::resource('drug-order', 'DrugOrderController');

    /* Services */
    Route::get('services/all', 'ServiceController@getAll');
    Route::post('services/{service}', 'ServiceController@update');
    Route::resource('services', 'ServiceController');

    Route::post('fcm', 'NotificationController@sendFCMNotification');

    /* Attachments */
    Route::get('attachments/{attachment}', 'OrderController@getAttachment');

    /* Drugs */
    Route::get('drugs/all', 'DrugController@getAll');
    Route::post('drugs/{drug}', 'DrugController@update');
    Route::resource('drugs', 'DrugController');

    /* Pharmacy Categories */
    Route::resource('pharmacy-categories', 'PharmacyCategoryController');

    /* Ads */
    Route::post('advertisements/{advertisement}', 'AdvertisementController@update');
    Route::resource('advertisements', 'AdvertisementController');

    /* Areas */
    Route::get('areas/all', 'AreaController@getAll');
    Route::post('areas/{area}', 'AreaController@update');
    Route::resource('areas', 'AreaController');

});
