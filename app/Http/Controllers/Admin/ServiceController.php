<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Resources\Admin\Services\ServiceResource;
use App\Http\Resources\Admin\Services\ShowServiceResource;

class ServiceController extends AdminBaseController
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderDisplay()->with(['examination', 'serviceProviderType']);
        $services = $this->filter($services)->paginate(config('kashf.paginate_per_page'));
        $services->withPath(url()->full());
        $services = ServiceResource::collection($services);
        return customPagination($services);
    }

    public function getAll()
    {
        return Service::get(['id', 'title']);
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
        $iconName = $this->uploadImageBase64($request->icon, iconPath(), $request->slug);

        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $iconName,
            'service_provider_type_id' => $request->service_provider_type_id,
            'estimation_from' => $request->estimation_from,
            'estimation_to' => $request->estimation_to,
            'price' => $request->price,
            'display_order' => $request->display_order,
            'examination_id' => $request->examination_id,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ShowServiceResource($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return new ShowServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $iconName = $this->uploadImageBase64($request->icon, iconPath(), $service->slug);

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $iconName ?? $service->icon,
            'service_provider_type_id' => $request->service_provider_type_id,
            'estimation_from' => $request->estimation_from,
            'estimation_to' => $request->estimation_to,
            'price' => $request->price,
            'display_order' => $request->display_order,
            'examination_id' => $request->examination_id,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);
        return new ShowServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    public function filter($services)
    {
        if (request('title')) {
            $services->where('title', "like", "%" . request('title') . "%");
        }

        if (request('service_provider_type_id')) {
            $services->where('service_provider_type_id', request('service_provider_type_id'));
        }

        if (isset(request()->status)) {
            $services->where('status', request('status'));
        }

        if (request('examination_id')) {
            $services->where('examination_id', request('examination_id'));
        }

        return $services;
    }
}
