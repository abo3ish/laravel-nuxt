<?php

namespace App\Http\Requests\User;

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
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',

            'area_id' => 'required|exists:areas,id',
            'street' => 'required',
            'lat' => 'required',
            'lng' => 'required',

            'push_token' => 'required',
            'device_type' => 'required',
            'details' => 'required'
        ];
    }
}
