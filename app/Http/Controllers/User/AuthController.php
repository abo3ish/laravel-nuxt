<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Events\Login;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UserProviderTrait;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\AdvertisementTrait;
use App\Http\Traits\FCMTrait;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers, UserProviderTrait, AdvertisementTrait, FCMTrait;


    public function login(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return apiReturn([], ['wrong credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->guard()->user();

        $this->guard()->setToken($token);
        $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'login');

        $user->updatePushToken($request->push_token, 'android');

        $user->token = $token;
        $data = new MeResource($user);
        $ads = $this->getPageAd('home');

        $data = collect(["ads" => $ads, "user" => $data]);

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function socialLogin(Request $request)
    {
        try {
            $socialUser = Socialite::driver(strtolower($request->social_provider))->userFromToken($request->access_token);

            if (!$user = User::where('social_id', $socialUser->getId())
                ->where('social_provider', strtolower($request->social_provider))
                ->first()) {

                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_provider' => $request->social_provider,
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]);
            }
            $token = auth()->login($user);

            $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'social-login');

            $user->updatePushToken($request->push_token, 'android');

            $user->token = $token;
            $data = new MeResource($user);
            $ads = $this->getPageAd('home');

            $data = collect(["ads" => $ads, "user" => $data]);

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            return apiReturn('Something went wrong', null, Response::HTTP_BAD_REQUEST);
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

    public function testFcm($token)
    {

        if (!$token) {
            $token = auth()->user()->push_token;
        }

        return $this->sendFCM(
            'كشف ودوا',
            'رسالة اختبار',
            '',
            $token
        );
    }
}
