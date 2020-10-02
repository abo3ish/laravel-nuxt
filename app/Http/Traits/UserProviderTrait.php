<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\Device;

trait UserProviderTrait
{

    protected function addToDevices($device_type, $details = '', $user_type, $ip, $operation = 'register')
    {
        $namespace =  new \ReflectionClass(User::class);
        $namespace = $namespace->getNamespaceName() . "\\";
        if ($user_type instanceof User) {
            $namespace = $namespace . 'User';
        } else {
            $namespace = $namespace . 'ServiceProvider';
        }
        $array = [
            'deviceable_id' => $user_type->id,
            'deviceable_type' => $namespace,
            'deviceable_ip' => $ip,
            'process_type' => strtolower($operation),
            'device_type' => strtolower($device_type),
            'details' => $details ? strtolower($details) : strtolower(request()->userAgent()),
        ];
        Device::create($array);
    }
}
