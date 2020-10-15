<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Order;
use App\Models\Service;
use App\Events\NewOrder;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\Api\Order\ShowOrderResource;
use App\Http\Resources\Order\OrderHistoryResource;
use App\Http\Resources\Api\Order\StoreOrderResource;
use App\Models\OrderAttachment;

class OrderController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('user_id', auth()->id())->paginate(config('kashf.pagination_per_small_page'));
        $data = OrderHistoryResource::collection($orders);
        $data = customPagination($data, 'orders');

        return apiReturn($data, null, Response::HTTP_OK);

    }

    public function show(Order $order)
    {
        // dd($order->attachments);
        $order = new ShowOrderResource($order);
        return apiReturn($order, null, Response::HTTP_OK);
    }

    /*
        Store Service Orders Not Pharmacy
    */
    public function store(Request $request)
    {
        try {
            $serviceProviderTypeId = Service::find($request->items[0])->service_provider_type_id;

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::SERVICE,
                'address_id' => $request->address_id,
                'service_provider_type_id' => $serviceProviderTypeId
            ]);

            if (count($request->items) > 1) {
                $service = Service::findOrFail($request->items[0]);
                if (!$service->examination->accept_multi) {
                    return apiReturn(null, "You can not choose more than one service.", Response::HTTP_OK);
                }
            }
            foreach ($request->items as $item) {
                $service = Service::findOrFail($item);
                ServiceOrder::create([
                    'order_id' => $order->id,
                    'service_id' => $item,
                    'purchase_price' => $service->purchase_price,
                    'sell_price' => $service->sell_price,
                ]);
            }

            $data = new StoreOrderResource($order);

            // event(new NewOrder($order));     // notify Admin

            return apiReturn($data, null, Response::HTTP_OK);

        } catch (Exception $e) {
            return apiReturn($e, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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

    public function reorder(Order $order)
    {
        $serviceOrders = $order->serviceOrders;
        // dd($serviceOrders);
        try {
            $serviceProviderTypeId = Service::find($serviceOrders->first()->service->id)->service_provider_type_id;

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::SERVICE,
                'address_id' => $order->address_id,
                'service_provider_type_id' => $serviceProviderTypeId
            ]);

            if (count($serviceOrders) > 1) {
                $service = Service::findOrFail($serviceOrders->first()->service->id);
                if (!$service->examination->accept_multi) {
                    return apiReturn(null, "You can not choose more than one service.", Response::HTTP_OK);
                }
            }
            foreach ($serviceOrders as $serviceOrder) {
                $service = Service::findOrFail($serviceOrder->service->id);
                ServiceOrder::create([
                    'order_id' => $order->id,
                    'service_id' => $service->id,
                    'purchase_price' => $service->purchase_price,
                    'sell_price' => $service->sell_price,
                ]);
            }

            $data = new StoreOrderResource($order);

            // event(new NewOrder($order));     // notify Admin

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            return apiReturn($e, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAttachment(OrderAttachment $attachment)
    {
        if ($attachment->order->user_id != auth()->id()) {
            return apiReturn(null, ["you don't have access to this file"], Response::HTTP_FORBIDDEN);
        }
        if ($attachment->type == 'audio') {
            return  response()->file(getOrderAudioPath($attachment->name));
        } elseif ($attachment->type == 'image' || $attachment->type == 'text') {
            return  response()->file(getOrderImagePath($attachment->name));
        }
    }
}
