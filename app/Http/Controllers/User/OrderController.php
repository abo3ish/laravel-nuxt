<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Order;
use App\Models\Service;
use App\Events\NewOrder;
use App\Models\BillCycle;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Models\OrderAttachment;
use App\Http\Traits\DiscountTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiBaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Order\OrderHistoryResource;
use App\Http\Resources\Api\Order\ShowOrderResource;
use App\Http\Resources\Api\Order\StoreOrderResource;

class OrderController extends ApiBaseController
{
    use DiscountTrait, OrderTrait;
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
        $order = new ShowOrderResource($order);
        return apiReturn($order, null, Response::HTTP_OK);
    }

    /*
        Store Service Orders Not Pharmacy
    */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $serviceProviderType = Service::find($request->items[0])->serviceProviderType;
            $billCycle = BillCycle::where('status', 1)->first();
            $deliveryPrice = 0;

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'address_id' => $request->address_id,
                'service_provider_type_id' => $serviceProviderType->id,
                'bill_cycle_id' => $billCycle->id,
                'type' => Order::SERVICE,
                'tax_price' => 0,
                'delivery_price' => $deliveryPrice,
                'profit_percentage' => $serviceProviderType->profit_percentage,
            ]);

            if (count($request->items) > 1) {
                $service = Service::findOrFail($request->items[0]);
                if (!$service->examination->accept_multi) {
                    return apiReturn(null, "You can not choose more than one service.", Response::HTTP_OK);
                }
            }

            $actualPrice = 0;
            $totalDiscount = 0;
            foreach ($request->items as $item) {
                $actualPrice += $service->price;
                $service = Service::findOrFail($item);

                $serviceOrder = ServiceOrder::create([
                    'order_id' => $order->id,
                    'service_id' => $item,
                    'price' => $service->price
                ]);
                $totalDiscount += $this->handleDiscount($service, $serviceOrder);
            }

            $order->update([
                'actual_price' => $actualPrice,
                'subtotal' => $actualPrice - $totalDiscount,
                'price_to_pay' => ($actualPrice - $totalDiscount) + $deliveryPrice,
                'discount_price' => $totalDiscount
            ]);

            $data = new StoreOrderResource($order);

            // event(new NewOrder($order));     // notify Admin
            DB::commit();
            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
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
                    'price' => $service->price
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

    public function acceptOrder(Order $order)
    {
        $order->update([
            'status' => 2,
            'service_provider_id' => auth()->id(),
            'accepted_at' => now()
        ]);

        // notifiy user
    }

    public function startOrder(Order $order)
    {
        $order->update([
            'status' => 3,
            'started_at' => now()
        ]);
    }

    public function arrived(Order $order)
    {
        $order->update([
            'status' => 4,
            'arrived_at' => now()
        ]);
        // notifiy user
    }

    public function endOrder(Order $order)
    {
        $order->update([
            'status' => 5,
            'actual_profit' => $this->calculateActualProfit($order),
            'company_profit' => $this->calculateCompanyProfit($order),
            'service_provider_profit' => $this->calculateServiceProviderProfit($order),
            'ended_at' => now()
        ]);

        // notify User
    }

    public function cancelOrder(Order $order)
    {
        $order->update([
            'status' => 0,
            'canceled_at' => now()
        ]);
        // notify User
    }
}
