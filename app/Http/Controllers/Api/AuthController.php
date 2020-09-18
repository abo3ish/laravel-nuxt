<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Events\Login;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Http\Traits\UserProviderTrait;
use App\Http\Resources\User\MeResource;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Traits\AdvertisementTrait;

class AuthController extends Controller
{
    use AuthenticatesUsers, UserProviderTrait, AdvertisementTrait;


    public function login(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return apiReturn([], ['wrong credentials'], Response::HTTP_UNAUTHORIZED);

        }

        $user = $this->guard()->user();

        $this->guard()->setToken($token);
        $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'login');
        $user->token = $token;
        $data = new MeResource($user);
        $ads = $this->getPageAd('home');

        $data = collect(["ads" => $ads, "user" => $data]);

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function socialLogin(Request $request)
    {
        $socialUser = Socialite::driver(strtolower($request->social_provider))->userFromToken($request->access_token);

        if ($user = User::where('social_id', $socialUser->getId())
            ->where('social_provider', strtolower($request->social_provider))
            ->first()
        ) {
            $token = auth()->login($user);

            $user->token = $token;
            $data = new MeResource($user);
            $ads = $this->getPageAd('home');

            $data = collect(["ads" => $ads, "user" => $data]);

            return apiReturn($data, null, Response::HTTP_OK);
        } else {

        }
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
