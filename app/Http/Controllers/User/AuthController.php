<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Events\Login;
use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\FCMTrait;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\UserProviderTrait;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\AdvertisementTrait;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers, UserProviderTrait, AdvertisementTrait, FCMTrait;


    public function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return apiReturn([], [trans('errors.wrong_credentials')], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken($request->device_type . "-login")->plainTextToken;

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
            $token = $user->createToken($request->device_type . "-login")->plainTextToken;


            $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'social-login');

            $user->updatePushToken($request->push_token, 'android');

            $user->token = $token;
            $data = new MeResource($user);
            $ads = $this->getPageAd('home');

            $data = collect(["ads" => $ads, "user" => $data]);

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            return apiReturn(null, [trans('errors.500')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
            ]);

            Address::create([
                'user_id' => $user->id,
                'area_id' => $request->area_id,
                'street' => $request->street,
                'building_number' => $request->building_number,
                'floor_number' => $request->floor_number,
                'flat_number' => $request->flat_number,
                'lat' => $request->lat,
                'lng' => $request->lng
            ]);

            $token = $user->createToken($request->device_type . "-login")->plainTextToken;

            $this->addToDevices($request->device_type, $request->details, $user, $request->ip(), 'social-login');

            $user->updatePushToken($request->push_token, 'android');

            $user->token = $token;
            $data = new MeResource($user);
            $ads = $this->getPageAd('home');

            $data = collect(["ads" => $ads, "user" => $data]);

            DB::commit();
            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return apiReturn(null, [trans('errors.500')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        request()->user()->currentAccessToken()->delete();

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
