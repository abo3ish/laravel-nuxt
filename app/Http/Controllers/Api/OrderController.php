<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExaminationOrder;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\AllOrdersResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = ExaminationOrder::where('user_id', auth()->id())->get();
        return AllOrdersResource::collection($orders);
    }
}
