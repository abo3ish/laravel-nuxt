<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

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
        $serviceProviders = $serviceProviders->paginate(5);
        $serviceProviders->withPath(url()->full());
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
        return $serviceProvider;
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
        return $serviceProvider;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
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
