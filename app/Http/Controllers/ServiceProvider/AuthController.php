<?php

namespace App\Http\Controllers\ServiceProvider;

use Exception;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceProviderType;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\UserProviderTrait;
use App\Http\Traits\VerificationTrait;
use App\Http\Controllers\ApiBaseController;
use App\Models\ServiceProviderVerification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\ServiceProvider\RegisterRequest;
use App\Http\Resources\Api\ServiceProvider\MeResource;

class AuthController extends ApiBaseController
{
    use AuthenticatesUsers, UserProviderTrait, VerificationTrait;

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

    public function register(RegisterRequest $request, ServiceProviderType $serviceProviderType)
    {
        try {
            DB::beginTransaction();

            $provider = ServiceProvider::create([
                'type_id' => $serviceProviderType->id,
                'name' => $request->name,
                // 'national_id' => $request->national_id,
                'phone' => $request->phone,
                'area_id' => $request->area_id,
                'image' => $request->image,
                'password' => $request->password,
                'status' => 7
            ]);

            $this->handleVerification($provider);
            $provider->refresh();

            $token = $provider->createToken($request->device_type . "-register")->plainTextToken;
            $this->addToDevices($request->device_type, $request->details, $provider, $request->ip(), 'Register');

            $provider->updatePushToken($request->push_token);

            $provider->token = $token;
            return $provider;
            $data = new MeResource($provider);

            DB::commit();
            return apiReturn($data, [], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return apiReturn(null, [$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            "success" => true
        ]);
    }
}
