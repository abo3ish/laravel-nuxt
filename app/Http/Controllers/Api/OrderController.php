<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderService;
use Illuminate\Http\Request;
use App\Models\ExaminationOrder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\AllOrdersResource;
use App\Http\Resources\Order\StoreOrderResource;
use App\Http\Resources\Order\UserHistoryResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return UserHistoryResource::collection($orders);
    }

    public function store(Request $request)
    {
        try {

            $order = Order::create([
                'user_id' => auth()->id(),
                'type' => 'service',
                'address_id' => $request->address_id
                ]);

            if ($request->type == 'service') {
                foreach($request->items as $item) {
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
            return response()->json([
                'data' => $data,
                'message' => "طلب رقم {$order->id} سيتم التواصل معكم خلال دقائق ..."
                ]);
        } catch (Exception $e) {
            return response()->json([
                'data' => '',
                'message' => "حدث خطأ ما، برجاء إعادة المحاولة"
            ]);
        }
    }
}
