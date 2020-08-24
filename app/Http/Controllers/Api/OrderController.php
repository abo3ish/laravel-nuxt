<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Order;
use App\Models\Service;
use App\Events\NewOrder;
use App\Models\OrderService;
use Illuminate\Http\Request;
use App\Models\ExaminationOrder;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Order\AllOrdersResource;
use App\Http\Resources\Order\StoreOrderResource;
use App\Http\Resources\Order\UserHistoryResource;

class OrderController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $data = UserHistoryResource::collection($orders);

        return apiReturn($data, true, '', Response::HTTP_OK);

    }

    public function store(Request $request)
    {
        try {

            $order = Order::create([
                'uuid' => $this->generateUuid(),
                'user_id' => auth()->id(),
                'type' => 'service',
                'address_id' => $request->address_id
            ]);

            if ($request->type == 'service') {
                foreach ($request->items as $item) {
                    $service = Service::find($item);
                    OrderService::create([
                        'order_id' => $order->id,
                        'service_id' => $item,
                        'purchase_price' => $service->purchase_price,
                        'sell_price' => $service->sell_price,
                    ]);
                }
            }

            $data = new StoreOrderResource($order);

            // event(new NewOrder($order));
            return apiReturn($data, true, '', Response::HTTP_OK);
        } catch (Exception $e) {
            return apiReturn($e, false, 'حدث خطأ ما، برجاء إعادة المحاولة', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function generateUuid()
    {
        $uuid = random_int(1000000, 9999999);

        if (Order::where('uuid', $uuid)->first()) {
            $this->generateUuid();
        }
        return $uuid;
    }
}
