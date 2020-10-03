<?php

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

function getIcon($icon)
{
    return file_exists(iconPath($icon)) ? url((iconPath($icon))) : null;
}

function getAd($ad)
{
    return file_exists(adPath($ad)) ? url((adPath($ad))) : url(adPath('homeAd1.jpg'));
}

function getDrugImage($drug)
{
    return file_exists(drugPath($drug)) ? url((drugPath($drug))) : url((drugPath('drug-default.png')));
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
