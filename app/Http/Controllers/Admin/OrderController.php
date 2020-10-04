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
        $orders = Order::with(['user', 'serviceProvider', 'address', 'services'])->orderBy('created_at', 'desc');

        $orders = $this->filter($orders);
        $orders = $orders->paginate(config('kashf.pagination_per_page'));
        $orders = OrderResource::collection($orders);
        $orders->withPath(url()->full());
        $orders = customPagination($orders, 'orders');
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

    public function filter($orders)
    {

        if (isset(request()->uuid) && request()->uuid) {
            $orders->where('uuid', request('uuid'));
        }

        if (isset(request()->status)) {
            $orders->where('status', request('status'));
        }

        if (isset(request()->service_provider_id)) {
            $orders->where('service_provider_id', request('service_provider_id'));
        }


        if (isset(request()->service_provider_type_id) && request()->service_provider_type_id) {
            $orders->where('service_provider_type_id', request()->service_provider_type_id);
        }

        return $orders;
    }

    public function getOrderStatuses()
    {
        return Order::statuses();
    }
}
