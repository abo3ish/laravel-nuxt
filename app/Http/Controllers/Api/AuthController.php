<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;


    public function login(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return false;
        }

        $user = $this->guard()->user();
        // if ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()) {
        //     return false;
        // }

        $this->guard()->setToken($token);

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
