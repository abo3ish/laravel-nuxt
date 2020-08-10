<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Resources\Admin\Orders\OrderResource;

class OrderController extends AdminController
{
    public function index()
    {
        $orders = Order::orderBy('created_at')->with(['user', 'serviceProvider', 'address', 'services'])->paginate(15);
        $orders = OrderResource::collection($orders);

        return $orders;
    }
}
