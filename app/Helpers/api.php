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
function AdPath($ad = null)
{
    return 'images/ads/' . $ad;
}

function getIcon($icon)
{
    return file_exists(iconPath($icon)) ? url((iconPath($icon))) : null;
}

function getAd($ad)
{
    return file_exists(AdPath($ad)) ? url((AdPath($ad))) : url(AdPath('homeAd1.png'));
}
