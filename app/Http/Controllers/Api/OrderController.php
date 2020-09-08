<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Order;
use App\Models\Service;
use App\Events\NewOrder;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use App\Models\ExaminationOrder;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Order\AllOrdersResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Order\UserHistoryResource;
use App\Http\Resources\Api\Order\StoreOrderResource;

class OrderController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->paginate(5);
        $data = UserHistoryResource::collection($orders);
        $data = [
            'orders' => $data->items(),
            'pagination' => [
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'next_page_url' => $data->nextPageUrl(),
                'previous_page_url' => $data->previousPageUrl(),
                'first_item' => $data->firstItem(),
                'last_item' => $data->lastItem(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ]
        ];

        return apiReturn($data, null, Response::HTTP_OK);

    }

    /*
        Store Service Orders Not Pharmacy
    */
    public function store(Request $request)
    {
        try {

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::SERVICE,
                'address_id' => $request->address_id
            ]);
            if (count($request->items) > 1) {
                $service = Service::findOrFail($request->items[0]);
                if (!$service->examination->accept_multi) {
                    throw new Exception();
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

            // event(new NewOrder($order));     // notify the user

            return apiReturn($data, null, Response::HTTP_OK);

        } catch (Exception $e) {
            return apiReturn($e, 'حدث خطأ ما، برجاء إعادة المحاولة', Response::HTTP_INTERNAL_SERVER_ERROR);
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
