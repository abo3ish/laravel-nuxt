<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['guest:api'], 'namespace' => 'Admin'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['assign.guard:admin'], 'namespace' => 'Admin'], function () {
    Route::get('me', 'MeController@index');
    Route::get('user', 'MeController@index');

    Route::get('service-providers', 'ServiceProviderController@index');
});
