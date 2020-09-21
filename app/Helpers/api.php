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
    return 'public/images/icons/' . $icon;
}
function AdPath($ad = null)
{
    return 'public/images/ads/' . $ad;
}
