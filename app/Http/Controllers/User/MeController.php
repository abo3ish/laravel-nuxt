<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\AdvertisementTrait;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\User\UpdateMeRequest;
use Symfony\Component\HttpFoundation\Response;

class MeController extends ApiBaseController
{
    use AdvertisementTrait;

    public function index()
    {
        $data = new MeResource(auth()->user());

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function update(UpdateMeRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return apiReturn('', null, Response::HTTP_OK);

    }

    public function destroy()
    {
        $orders = Order::where('user_id', auth()->user()->id)->delete();
        $addresses = Address::where('user_id', auth()->user()->id)->delete();
        $user = auth()->user();
        $user->tokens()->delete();
        $user->delete();

        return apiReturn(null, '');
    }

    public function checkPhoneNumber($phone_number)
    {
        $data = [
            'user_exists' => null
        ];
        if (User::where('phone', $phone_number)->first()) {
            $data['user_exists'] = true;
            return apiReturn($data, null, Response::HTTP_OK);
        }
        $data['user_exists'] = false;
        return apiReturn($data, null, Response::HTTP_NOT_FOUND);
    }
}
