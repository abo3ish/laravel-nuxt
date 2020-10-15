<?php

namespace App\Http\Controllers\User;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Resources\User\MeResource;
use Symfony\Component\HttpFoundation\Response;

class MeController extends ApiBaseController
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        $data = new MeResource($this->auth->user());

        return apiReturn($data, null, Response::HTTP_OK);
    }
}
