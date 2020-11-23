<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drug;
use App\Models\DrugOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminBaseController;

class DrugOrderController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $drug = Drug::findOrFail($request->drug_id);
        $drugOrder = DrugOrder::create([
            'order_id' => $request->order_id,
            'drug_id' => $request->drug_id,
            'quantity' => $request->quantity,
            'price' => $drug->price,
        ]);

        return $drugOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugOrder  $drugOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DrugOrder $drugOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugOrder  $drugOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugOrder $drugOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DrugOrder  $drugOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugOrder $drugOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugOrder  $drugOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugOrder $drugOrder)
    {
        //
    }
}
