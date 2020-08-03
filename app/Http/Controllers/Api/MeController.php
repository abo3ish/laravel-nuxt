<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\User\MeResource;
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
            'data' => new MeResource($this->auth->user()),
            'message' => ''
        ], 200);
    }
}
