<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Drug;
use App\Models\Order;
use App\Models\DrugOrder;
use Illuminate\Http\Request;
use App\Models\ServiceProviderType;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\Order\StoreOrderResource;

class CartController extends Controller
{
    public function checkout(Request $request)
    {

        try {
            $serviceProviderTypeId = ServiceProviderType::where('slug', 'pharmacy')->first()->id;

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::PHARMACY,
                'address_id' => $request->address_id,
                'service_provider_type_id' => $serviceProviderTypeId
            ]);
            foreach ($request->items as $item) {
                $drug = Drug::findOrFail($item['id']);
                DrugOrder::create([
                    'order_id' => $order->id,
                    'drug_id' => $drug->id,
                    'quantity' => $item['quantity'],
                    'purchase_price' => $drug->price - (5 / 100) * $drug->price,
                    'sell_price' => $drug->price,
                ]);
            }

            $data = new StoreOrderResource($order);

            // event(new NewOrder($order));     // notify the user

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            return apiReturn($e, [$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
