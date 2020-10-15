<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ExaminationOrder;
use Illuminate\Support\Facades\DB;
use App\Models\ExaminationServiceType;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiBaseController;

class ExaminationOrderController extends ApiBaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ExaminationOrder::where('user_id', auth()->id())->get();
        return apiReturn($data, null, Response::HTTP_OK);
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
        // dd($examinationServiceType->price);

        try {
            $order = ExaminationOrder::create([
                'user_id' => auth()->id(),
                'examination_service_type_id' => $request->examination_service_type_id,
                'subtotal_price' => $examinationServiceType->price,
                'tax_price' => 0,
                'discount_price' => 0,
                'total_price' => $this->calculateTotalPrice($examinationServiceType->price, 0, 0),
                'address_id' => $request->address_id
            ]);

            // event(new OrderCreated());
            DB::commit();
            return response()->json(
                [
                    "order_id" => $order->id
                ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
            return collect([
                'success' => false,
                'message' => 'something went wrong, please try again'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationOrder  $examinationOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationOrder $examinationOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationOrder  $examinationOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationOrder $examinationOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationOrder  $examinationOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationOrder $examinationOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationOrder  $examinationOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationOrder $examinationOrder)
    {
        //
    }

    public function calculateTotalPrice($price, $tax, $discount)
    {
        return $price - $tax - $discount;
    }
}
