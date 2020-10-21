<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Drug;
use App\Models\Order;
use App\Models\DrugOrder;
use Illuminate\Http\Request;
use App\Models\OrderAttachment;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceProviderType;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\Order\StoreOrderResource;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $items = json_decode(($request->items));

        try {
            DB::beginTransaction();

            $serviceProviderTypeId = ServiceProviderType::where('slug', 'pharmacy')->first()->id;

            if (!$request->audios && !$request->images && $request->text == '' && !is_array($items)) {
                return apiReturn(null, ['your cart is empty'], Response::HTTP_BAD_REQUEST);
            }

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::PHARMACY,
                'address_id' => $request->address_id,
                'service_provider_type_id' => $serviceProviderTypeId
            ]);

            if ($items && is_array($items)) {
                foreach ($items as $item) {
                    $drug = Drug::findOrFail($item->id);
                    DrugOrder::create([
                        'order_id' => $order->id,
                        'drug_id' => $drug->id,
                        'quantity' => $item->quantity,
                        'purchase_price' => $drug->price - (5 / 100) * $drug->price,
                        'sell_price' => $drug->price,
                    ]);
                }
            }

            if ($request->has('audios')) {
                foreach ($request->audios as $audio) {
                    $order->createOrderAttachment($audio, 'audio');
                }
            }

            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $order->createOrderAttachment($image, 'image');
                }
            }

            if ($request->text) {
                $order->createOrderTextAttachment($request->text);
            }

            $data = new StoreOrderResource($order);
            DB::commit();
            // event(new NewOrder($order));     // notify the user

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return apiReturn($e, [$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
