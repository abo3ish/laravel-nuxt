<?php

function apiReturn($data = null, $status = true, $error = '', $code = 200)
{
    return response()->json([
        'status' => $status,
        'data' => $data,
        'error' => $error,
        'code' => $code
    ], $code);
}
