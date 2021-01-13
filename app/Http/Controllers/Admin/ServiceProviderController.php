<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Resources\Admin\ServiceProvider\ShowServiceProviderResource;

class ServiceProviderController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::with('type')->orderBy('created_at', 'desc');

        $serviceProviders = $this->filter($serviceProviders);
        $serviceProviders = $serviceProviders->paginate(config('kashf.pagination_per_page'));
        $serviceProviders->withPath(url()->full());
        $serviceProviders = ShowServiceProviderResource::collection($serviceProviders);

        $serviceProviders = customPagination($serviceProviders);
        return $serviceProviders;
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
        ServiceProvider::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'type_id' => $request->type_id,
            'area_id' => $request->area_id,
            'age' => $request->age
        ]);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceProvider $serviceProvider)
    {
        return new ShowServiceProviderResource($serviceProvider->load('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        $serviceProvider->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,
            'password' => $request->password ? bcrypt($request->password) : $serviceProvider->password,
            'type_id' => $request->type_id,
            'age' => $request->age
        ]);
        return new ShowServiceProviderResource($serviceProvider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        $serviceProvider->delete();
        return true;
    }

    public function filter($serviceProviders)
    {
        if (request()->name) {
            $serviceProviders->where('name', 'like', "%" . request('name') . "%");
        }

        if (request()->phone) {
            $serviceProviders->where('phone', request('phone'));
        }

        if (isset(request()->status)) {
            $serviceProviders->where('status', request('status'));
        }

        if (isset(request()->type_id)) {
            $serviceProviders->where('type_id', request('type_id'));
        }

        if (isset(request()->area_id)) {
            $serviceProviders->where('area_id', request('area_id'));
        }

        if (isset(request()->address)) {
            $serviceProviders->where('address', request('address'));
        }

        if (isset(request()->age)) {
            $serviceProviders->where('age', request('age'));
        }

        return $serviceProviders;
    }

    public function search(Request $request)
    {
        return $request->all();
    }
}
