<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Drug;
use App\Models\Order;
use App\Models\Address;
use App\Models\BillCycle;
use App\Models\DrugOrder;
use Illuminate\Http\Request;
use App\Http\Traits\DiscountTrait;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceProviderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\Order\StoreOrderResource;

class CartController extends Controller
{
    use DiscountTrait;

    public function checkout(CheckoutRequest $request)
    {
        $items = is_array($request->items) ? $request->items : json_decode($request->items);

        try {
            if (!$request->audios && !$request->images && $request->text == '' && !is_array($items)) {
                return apiReturn(null, [trans('errors.empty_cart')], Response::HTTP_BAD_REQUEST);
            }

            DB::beginTransaction();

            $address = Address::findOrFail($request->address_id);
            $serviceProviderType = ServiceProviderType::where('slug', 'pharmacy')->first();
            $billCycle = BillCycle::where('status', 1)->first();
            $deliveryPrice = 10;

            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'address_id' => $request->address_id,
                'area_id' => $address->area_id,
                'street' => $address->street,
                'building_number' => $address->building_number,
                'floor_number' => $address->floor_number,
                'flat_number' => $address->flat_number,
                'lat' => $address->lat,
                'lng' => $address->lng,
                'service_provider_type_id' => $serviceProviderType->id,
                'bill_cycle_id' => $billCycle->id,
                'type' => Order::PHARMACY,
                'tax_price' => 0,
                'delivery_price' => $deliveryPrice,
                'profit_percentage' => $serviceProviderType->profit_percentage,

            ]);

            $actualPrice = 0;
            $totalDiscount = 0;
            if ($items && is_array($items)) {
                foreach ($items as $item) {

                    $drug = Drug::findOrFail($item->id);
                    $actualPrice += $drug->price * $item->quantity;
                    $drugOrder = DrugOrder::create([
                        'order_id' => $order->id,
                        'drug_id' => $drug->id,
                        'quantity' => $item->quantity,
                        'price' => $drug->price,
                    ]);
                    $totalDiscount += $this->handleDiscount($drug, $drugOrder);
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

            $order->update([
                'actual_price' => $actualPrice,
                'subtotal' => $actualPrice - $totalDiscount,
                'price_to_pay' => ($actualPrice - $totalDiscount) + $deliveryPrice,
                'discount_price' => $totalDiscount,
            ]);

            $data = new StoreOrderResource($order);
            DB::commit();
            // event(new NewOrder($order));     // notify the user

            return apiReturn($data, null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return apiReturn(null, [trans('errors.500')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
