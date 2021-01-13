<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MeController extends AdminBaseController
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return response()->json([
            'data' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $admin = auth()->user();

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'data' => $admin->refresh(),
        ]);

    }

    public function updatePassword(Request $request)
    {
        $admin = auth()->user();

        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data' => $admin->refresh(),
        ]);

    }
}
