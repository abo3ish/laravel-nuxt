<?php

namespace App\Http\Traits;

use App\Models\ServiceProviderType;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceProviderVerification;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
trait VerificationTrait
{
    public function handleVerification($provider)
    {
        if ($provider->serviceProviderType->slug == ServiceProviderType::DELIVERY) {
            foreach (ServiceProviderVerification::deliveryVerifications as $deliveryVerification) {
                $this->storeVerification($provider, $deliveryVerification, request($deliveryVerification . '_number'), request($deliveryVerification . '_image'));
            }
        }
        if ($provider->serviceProviderType->slug == ServiceProviderType::NURSE) {
            foreach (ServiceProviderVerification::nurseVerifications as $deliveryVerification) {
                $this->storeVerification($provider, $deliveryVerification, request($deliveryVerification . '_number'), request($deliveryVerification . '_image'));
            }
        }
    }

    public function storeVerification($provider, $type, $number, $fileName)
    {
        $fileName = $this->uploadVerification($provider, $type, $number, $fileName);

        ServiceProviderVerification::create([
            'service_provider_id' => $provider->id,
            'type' => $type,
            'number' => $number,
            'image' => $fileName,
        ]);
    }

    public function uploadVerification($provider, $type, $number, $image)
    {
        $directory = 'private/verifications';
        $fileName = $type . "-" . $provider->name . "-" . $number . "." . $image->extension();
        $image->storeAs($directory, $fileName);
        return $fileName;
    }
}
