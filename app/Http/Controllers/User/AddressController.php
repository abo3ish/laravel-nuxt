<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\Address\AddressResource;

class AddressController extends ApiBaseController
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area_id' => 'required',
            'street' => 'required',
            'floor_number' => 'required',
            'flat_number' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if ($validator->fails()) {
            return apiReturn(null, $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $address = Address::create([
            'user_id' => auth()->id(),
            'area_id' => $request->area_id,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        $data = new AddressResource($address);
        return apiReturn($data, null, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if (auth()->user()->id == $address->user_id) {
            $address->delete();

            return apiReturn(null, null, 200);
        } else {
            return apiReturn(null, 'Permision Denied', Response::HTTP_FORBIDDEN);
        }
    }
}
