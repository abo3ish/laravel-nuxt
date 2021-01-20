<?php

namespace App\Http\Controllers\ServiceProvider;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Hash;
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
        $provider = ServiceProvider::where('national_id', $request->national_id)->first();

        if (!$provider || !Hash::check($request->password, $provider->password)) {
            return apiReturn([], [trans('errors.wrong_credentials')], Response::HTTP_UNAUTHORIZED);
        }
        $token = $provider->createToken($request->device_type . "-login")->plainTextToken;

        $this->addToDevices($request->device_type, $request->details, $provider, $request->ip(), 'login');

        $provider->updatePushToken($request->push_token);

        $provider->token = $token;
        $data = new MeResource($provider);

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $provider = ServiceProvider::create([
            'type_id' => $request->type_id,
            'name' => $request->name,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'area_id' => $request->area_id,
            // 'Syndicate_id' => $request->Syndicate_id,
            // 'practicing_id' => $request->practicing_id,
            'image' => $request->image,
            'password' => $request->password,
            'status' => 7
        ]);
        // dd(ServiceProvider::find($provider->id));
        $provider->refresh();

        $token = $provider->createToken($request->device_type . "-register")->plainTextToken;

        $this->addToDevices($request->device_type, $request->details, $provider, $request->ip(), 'login');

        $provider->updatePushToken($request->push_token);

        $provider->token = $token;
        $data = new MeResource($provider);

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            "success" => true
        ]);
    }
}
