<?php

namespace App\Http\Controllers\Api;

use App\Events\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Advertisement\AdvertisementResource;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\UserProviderTrait;
use App\Models\Advertisement;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers, UserProviderTrait;


    public function login(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return false;
        }

        $user = $this->guard()->user();

        $this->guard()->setToken($token);
        $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'login');
        $user->token = $token;
        $data = new MeResource($user);
        $ads = AdvertisementResource::collection(Advertisement::where('slug', 'home')->get());

        $data = collect(["ads" => $ads, "user" => $data]);

        return apiReturn($data, true, '', Response::HTTP_OK);

        return response()->json([
            'token' => $token,
            'user' => $user                 // make resource for the user
        ]);
    }

    public function register()
    {

    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            "success" => true
        ]);
    }
}
