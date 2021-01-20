<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'service-provider',
        'namespace' => 'ServiceProvider'
    ],
    function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
    }
);

Route::group(
    [
        'prefix' => 'service-provider',
        'middleware' => ['auth:service_provider'],
        'namespace' => 'ServiceProvider'
    ],
    function () {
        Route::get('orders', 'OrderController@index');
        Route::get('orders/{order}', 'OrderController@show');
    }
);
