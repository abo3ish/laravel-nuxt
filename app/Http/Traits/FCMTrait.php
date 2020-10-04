<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait FCMTrait {

    public function sendFCM($title, $body, $data, $tokens)
    {
        $tokens = is_array($tokens) ? $tokens : array($tokens);
        $data = is_array($data) ? $data : null;
        $fields = array(
            'registration_ids' => $tokens,
            'data' => $data,
            'priority' => 'high',
            'notification' => array(
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'icon' => 'icon'
            )
        );
        $SendPush = Http::withHeaders(['Authorization' => 'key=' . config('kashf.fcm_server_key')])->post(env('FCM_API_URL'), $fields)->json();

        return collect($SendPush);
    }
}
