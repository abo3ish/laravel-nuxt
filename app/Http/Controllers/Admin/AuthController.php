<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;


    public function login(Request $request)
    {
        $user = Admin::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken($request->device_type . "-login")->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user                 // make resource for the user
        ]);
    }

    public function guard()
    {
        return auth()->guard('admin');
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            "success" => true
        ]);
    }
}
