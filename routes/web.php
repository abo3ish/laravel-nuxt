<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('config-clear/{user}', function ($user) {
    if ($user == 'abo3ish') {
        Artisan::call('config:clear');
        return 'done';
    } else {
        return redirect(404);
    }
});
Route::get('cache-clear/{user}', function ($user) {
    if ($user == 'abo3ish') {
        Artisan::call('cache:clear');
        return 'done';
    } else {
        return redirect(404);
    }
});

Route::get('config-cache/{user}', function ($user) {
    if ($user == 'abo3ish') {
        Artisan::call('config:cache');
        return 'done';
    } else {
        return redirect(404);
    }
});

Route::get('{path}', function () {
    return file_get_contents(public_path('_nuxt/index.html'));
})->where('path', '(.*)');
