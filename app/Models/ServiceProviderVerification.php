<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderVerification extends Model
{
    protected $fillable = [
        'service_provider_id', 'type', 'number', 'image'
    ];

    const deliveryVerifications = [
        'national_id',
        'driving_license'
    ];
    const doctorVerifications = [
        'national_id',
        'syndicate_id',
        'practicing_id'
    ];
    const nurseVerifications = [
        'national_id',
        'syndicate_id',
        'practicing_id'
    ];

    const laboratoryVerifications = [
        'lisense_id'
    ];

    const radiologistVerifications = [
        'lisense_id'
    ];

    public static function storeVerification($provider, $type, $number, $image)
    {
        $directory = 'private/verifications';
        $fileName = $type . "-" . $provider->name . "-" . $number . "." . $image->extension();
        $image->storeAs($directory, $fileName);

        self::create([
            'service_provider_id' => $provider->id,
            'type' => $type,
            'number' => $number,
            'image' => $image,
        ]);
    }
}
