<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Drug;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PharmacyOrder;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Resources\Api\Cart\CartResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Api\Order\StoreOrderResource;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;

class CartController extends ApiBaseController
{
    protected $cart;

    public function __construct()
    {
        $this->cart = Cart::instance(auth()->id());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->cart->restore(auth()->id());

        return apiReturn(CartResource::collection($this->cart->content()->values()->all()), null);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $drug = Drug::find($request->drug_id);
        $this->cart->add(
            $drug->id,
            $drug->name,
            $request->quantity,
            $drug->price
        );

        $this->cart->store(auth()->id());

        return apiReturn(CartResource::collection($this->cart->content()->values()->all()), null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            if ($request->quantity == 0) {
                $this->cart->remove($request->row_id);
            } else {
                $this->cart->update(
                    $request->row_id,
                    $request->quantity
                );
            }

            $this->cart->store(auth()->id());

            return apiReturn(CartResource::collection($this->cart->content()->values()->all()), null);

        } catch (InvalidRowIDException $e) {
            return apiReturn(null, ['Sorry, This item is not found'], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return apiReturn(null, ['Sorry, Something went wrong, please try again'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        try {
            $this->cart->remove($rowId);
            $this->cart->store(auth()->id());

            return apiReturn(null, null, Response::HTTP_OK);

        } catch (InvalidRowIDException $e) {
            return apiReturn(null, ['Sorry, This item is not found'], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {
            return apiReturn(null, ['Sorry, Something went wrong, please try again'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkout(Request $request)
    {

        try {
            $order = Order::create([
                'uuid' => Order::generateUuid(),
                'user_id' => auth()->id(),
                'type' => Order::PHARMACY,
                'address_id' => $request->address_id
            ]);
            foreach ($request->items as $item) {
                $drug = Drug::findOrFail($item['id']);
                PharmacyOrder::create([
                    'order_id' => $order->id,
                    'drug_id' => $drug->id,
                    // 'quantity' => $item['quantity'],
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
