<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ServiceProvider\Order\OrderResource;
use App\Http\Resources\ServiceProvider\Order\ShowOrderResource;
use App\Http\Resources\ServiceProvider\Order\OrderHistoryResource;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('service_provider_id', auth()->id())->orderBy('created_at', 'desc')->paginate(config('kashf.pagination_per_small_page'));
        $data = OrderHistoryResource::collection($orders);
        $data = customPagination($data, 'orders');

        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function show(Order $order)
    {
        if ($order->service_provider_id != auth()->id()) {
            return apiReturn('', ["you don't have access to this order"], Response::HTTP_FORBIDDEN);
        }
        $order = new ShowOrderResource($order);
        return apiReturn($order, null, Response::HTTP_OK);
    }
}
