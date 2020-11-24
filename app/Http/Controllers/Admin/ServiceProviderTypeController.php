<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceProviderType;
use Illuminate\Http\Request;

class ServiceProviderTypeController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceProviderTypes = ServiceProviderType::paginate(config('kashf.pagination_per_page'));
        return customPagination($serviceProviderTypes);

    }

    public function getAll()
    {
        $serviceProviderTypes = ServiceProviderType::get(['id', 'title']);
        return $serviceProviderTypes;

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
        ServiceProviderType::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'profit_percentage' => $request->profit_percentage,
        ]);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceProviderType  $serviceProviderType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceProviderType $serviceProviderType)
    {
        return $serviceProviderType;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceProviderType  $serviceProviderType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceProviderType $serviceProviderType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceProviderType  $serviceProviderType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceProviderType $serviceProviderType)
    {
        $serviceProviderType->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'profit_percentage' => $request->profit_percentage,
        ]);

        return $serviceProviderType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProviderType  $serviceProviderType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceProviderType $serviceProviderType)
    {
        //
    }
}
