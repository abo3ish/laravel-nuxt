<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExaminationServiceType;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Cart\ExaminationServiceCartResource;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;

class CartController extends ApiBaseController
{
    protected $cart;

    public function __construct()
    {
        // dd(Cart::instance(auth()->id()));

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
        // dd($this->cart->content()->values()->all());
        return response()->json([
            'success' => true,
            'data' =>  ExaminationServiceCartResource::collection($this->cart->content()->values()->all())
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $examinationServiceType = ExaminationServiceType::find($request->examination_service_type_id);
        $this->cart->add(
            $examinationServiceType,
            1
        );

        $this->cart->store(auth()->id());

        return response()->json([
            'success' => true,
            'data' => ExaminationServiceCartResource::collection($this->cart->content()->values()->all())
        ]);
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
                $this->cart->remove($request->rowId);
            } else {
                $this->cart->update(
                    $request->rowId,
                    $request->quantity
                );
            }

            $this->cart->store(auth()->id());

            return response()->json([
                'success' => true,
                'data' => ExaminationServiceCartResource::collection($this->cart->content()->values()->all())
            ]);
        } catch (InvalidRowIDException $e) {
            return response()->json([
                'success' => false,
                'message' => "Sorry, This item is not found"
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Sorry, Something went wrong, please try again"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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

            return response()->json([
                'success' => true,
                'message' => 'Item deleted successfully'
            ], 200);
        } catch (InvalidRowIDException $e) {
            return response()->json([
                "success" => false,
                "message" => "This item is not found in you Cart"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "somethings, went wrong"
            ], 404);
        }
    }
}
