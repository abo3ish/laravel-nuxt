<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'service-provider', 'middleware' => ['guest:api'], 'namespace' => 'ServiceProvider'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['prefix' => 'service-provider', 'middleware' => ['assign.guard:service_provider'], 'namespace' => 'ServiceProvider'], function () {
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{order}', 'OrderController@show');
});


