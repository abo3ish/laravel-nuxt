<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;

class MeController extends ApiBaseController
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->auth->user(),
        ], 200);
    }
}
