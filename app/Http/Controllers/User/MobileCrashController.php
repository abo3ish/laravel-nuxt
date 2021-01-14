<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Models\MobileCrash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileCrashController extends ApiBaseController
{
    public function store(Request $request)
    {
        $user_id = Auth::check() ? auth()->id() : null;
        MobileCrash::create([
            'device_info' => $request->device_info,
            'crash_log' => $request->crash_log,
            'user_id' => $user_id,
        ]);

        return apiReturn();
    }
}
