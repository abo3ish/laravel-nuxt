<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\AdvertisementTrait;
use App\Http\Controllers\ApiBaseController;
use Symfony\Component\HttpFoundation\Response;

class MeController extends ApiBaseController
{
    use AdvertisementTrait;
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

    public function update(Request $request)
    {
        $user = $this->auth->user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return apiReturn('', null, Response::HTTP_OK);

    }
}
