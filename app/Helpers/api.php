<?php

use Illuminate\Support\Facades\Storage;

function apiReturn($data = null, $error = null, $code = 200)
{
    return response()->json([
        'data' => $data,
        'error' => $error,
        'code' => $code
    ], $code);
}

function iconPath($icon = null)
{
    return 'images/icons/' . $icon;
}

function adPath($ad = null)
{
    return 'images/ads/' . $ad;
}

function drugPath($drug = null)
{
    return 'images/drugs/' . $drug;
}

function serviceProviderPath($serviceProvider = null)
{
    return 'images/service-providers/' . $serviceProvider;
}

function getOrderImagePath($img = null)
{
    return storage_path('app/private/images/' . $img);
}

function getOrderAudioPath($audio = null)
{
    return storage_path('app/private/audios/' . $audio);
}

function getIcon($icon)
{
    return is_file(iconPath($icon)) ? url((iconPath($icon))) : null;
}

function getAd($ad)
{
    return is_file(adPath($ad)) ? url((adPath($ad))) : url(adPath('homeAd1.jpg'));
}

function getDrugImage($drug)
{
    return is_file(drugPath($drug)) ? url((drugPath($drug))) : url((drugPath('drug-default.png')));
}

function getServiceProviderImage($image)
{
    return is_file(serviceProviderPath($image)) ? url((serviceProviderPath($image))) : null;
}

function customPagination($data, $string = 'data')
{
    $data = [
        $string => $data->items(),
        'pagination' => [
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage(),
            'next_page_url' => $data->nextPageUrl(),
            'previous_page_url' => $data->previousPageUrl(),
            'first_item' => $data->firstItem(),
            'last_item' => $data->lastItem(),
            'last_page' => $data->lastPage(),
            'total' => $data->total(),
        ]
    ];
    return $data;
}
