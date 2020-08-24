<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Resources\Admin\Orders\OrderResource;
use App\Http\Resources\Admin\Orders\ShowOrderResource;

class OrderController extends AdminController
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->with(['user', 'serviceProvider', 'address', 'services'])->paginate(15);
        $orders = OrderResource::collection($orders);

        return $orders;
    }

    public function show(Order $order)
    {
        return new ShowOrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'service_provider_id' => $request->service_provider_id
        ]);

        return new ShowOrderResource($order);
    }
}
