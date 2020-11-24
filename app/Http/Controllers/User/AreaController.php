<?php

namespace App\Http\Controllers\User;

use App\Models\Area;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\Api\Area\AreaResource;

class AreaController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('status', 1)->get();
        return apiReturn(AreaResource::collection($areas));
    }
}
