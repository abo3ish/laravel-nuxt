<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExaminationServiceType;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\ExaminationServiceType\ExaminationServiceTypeResource;

class ExaminationServiceTypeController extends ApiBaseController
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationServiceType  $examinationServiceType
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationServiceType $examinationServiceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationServiceType  $examinationServiceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationServiceType $examinationServiceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationServiceType  $examinationServiceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationServiceType $examinationServiceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationServiceType  $examinationServiceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationServiceType $examinationServiceType)
    {
        //
    }
}
