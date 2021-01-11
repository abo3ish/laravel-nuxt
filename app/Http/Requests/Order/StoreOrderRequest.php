<?php

namespace App\Http\Requests\Order;

use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
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
        // Service::pluck('id')->values();

        return [
            'address_id' => 'required|exists:addresses,id',
            'items' => function ($attribute, $value, $fail) {
                $firstServiceType = Service::findOrFail($value[0])->service_provider_type_id;
                foreach ($value as $item) {
                    $service = Service::find($item);
                    if (!$service) {
                        $fail($attribute . ' is invalid.');
                    }
                    if ($service && $service->service_provider_type_id != $firstServiceType) {
                        $fail($attribute . ' have to be in the same Examination Type');
                    }
                    if ($service && $service->parent_id == null && $service->childs->count()) {
                        $fail($attribute . " can't be choosen");
                    }
                }
            },
        ];
    }
}
