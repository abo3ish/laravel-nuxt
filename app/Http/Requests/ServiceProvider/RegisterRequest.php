<?php

namespace App\Http\Requests\ServiceProvider;

use App\Models\ServiceProviderType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|unique:service_providers,phone',
            'area_id' => 'required|exists:areas,id',
            'image' => 'image',

            'national_id_number' => 'required|integer|unique:service_provider_verifications,number',
            'national_id_image' => 'required|image',

            // Delivery
            'driving_license_number' => [
                'integer',
                'unique:service_provider_verifications,number',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::DELIVERY;
                }),
            ],
            'driving_license_image' => [
                'image',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::DELIVERY;
                }),
            ],

            // Nurse
            'syndicate_id_number' => [
                'integer',
                'unique:service_provider_verifications,number',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::NURSE;
                }),
            ],
            'syndicate_id_image' => [
                'image',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::NURSE;
                }),
            ],
            'practicing_id_number' => [
                'integer',
                'unique:service_provider_verifications,number',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::NURSE;
                }),
            ],
            'practicing_id_image' => [
                'image',
                Rule::requiredIf(function () {
                    return request('serviceProviderType')->slug == ServiceProviderType::NURSE;
                }),
            ]
        ];
    }
}
