<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\Address\AddressResource;
use App\Http\Requests\Api\Address\StoreAddressRequest;

class AddressController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        $data = AddressResource::collection($addresses);
        return apiReturn($data, null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $address = Address::create([
            'user_id' => auth()->id(),
            'area_id' => $request->area_id,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'landmark' => $request->landmark,
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
        if ($address->user->id != auth()->id()) {
            return apiReturn(null, [trans('errors.403')], Response::HTTP_FORBIDDEN);
        }
        $data = new AddressResource($address);
        return apiReturn($data, null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAddressRequest $request, Address $address)
    {
        if (auth()->id() != $address->user_id) {
            return apiReturn(null, [trans('errors.403')], Response::HTTP_FORBIDDEN);
        }

        $address->update([
            'area_id' => $request->area_id,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'landmark' => $request->landmark,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        $data = new AddressResource($address);
        return apiReturn($data, null, Response::HTTP_OK);
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
            return apiReturn(null, [trans('errors.403')], Response::HTTP_FORBIDDEN);
        }
    }
}
