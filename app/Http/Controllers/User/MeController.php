<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Order;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Resources\User\MeResource;
use App\Http\Traits\AdvertisementTrait;
use App\Http\Controllers\ApiBaseController;
use App\Models\Address;
use App\Models\ExaminationOrder;
use Symfony\Component\HttpFoundation\Response;

class MeController extends ApiBaseController
{
    use AdvertisementTrait;
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        $data = new MeResource($this->auth->user());

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $user = $this->auth->user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return apiReturn('', null, Response::HTTP_OK);

    }

    public function destroy()
    {
        $orders = Order::where('user_id', $this->auth->user()->id)->delete();
        $addresses = Address::where('user_id', $this->auth->user()->id)->delete();
        $addresses = ExaminationOrder::where('user_id', $this->auth->user()->id)->delete();
        $user = $this->auth->user();
        auth()->invalidate();
        $user->delete();


        return apiReturn(null, '');
    }
}
