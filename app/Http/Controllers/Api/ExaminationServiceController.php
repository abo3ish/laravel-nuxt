<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExaminationService;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\ExaminationService\ExaminationSerivceResource;
use App\Http\Resources\ExaminationService\ExaminationSerivcesResource;

class ExaminationServiceController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examinationServices = ExaminationService::all();
        return ExaminationSerivceResource::collection($examinationServices);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationService  $examinationService
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationService $examinationService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationService  $examinationService
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationService $examinationService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationService  $examinationService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationService $examinationService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationService  $examinationService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationService $examinationService)
    {
        //
    }
}
