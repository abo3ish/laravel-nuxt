<?php

namespace App\Http\Controllers\ServiceProvider;

use Illuminate\Http\Request;
use App\Http\Traits\UserProviderTrait;
use App\Http\Controllers\ApiBaseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Resources\Api\ServiceProvider\MeResource;

class AuthController extends ApiBaseController
{
    use AuthenticatesUsers, UserProviderTrait;

    public function login(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return apiReturn([], ['wrong credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $serviceProvider = $this->guard()->user();

        $this->guard()->setToken($token);

        $serviceProvider->updatePushToken($request->push_token);
        $this->addToDevices($request->device_type, $request->details, $serviceProvider, $request->ip(), 'login');

        $serviceProvider->token = $token;
        $data = new MeResource($serviceProvider);
        // $ads = $this->getPageAd('home');

        // $data = collect(["ads" => $ads, "user" => $data]);

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function guard()
    {
        return auth()->guard('service_provider');
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            "success" => true
        ]);
    }
}
