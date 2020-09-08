<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PharmacyCategory;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Api\Drug\DrugResource;
use App\Http\Resources\Api\PharmacyCategory\PharmacyCategoryResource;
use App\Models\Drug;

class PharmacyCategoryController extends ApiBaseController
{
    public function index()
    {
        $categories = PharmacyCategory::where('status', 1)->where('parent_id', null)->get();
        return apiReturn(PharmacyCategoryResource::collection($categories), null, Response::HTTP_OK);
    }

    public function show(PharmacyCategory $pharmacyCategory)
    {
        $drugs = Drug::where('category_id', $pharmacyCategory->id)->paginate(20);
        return apiReturn(DrugResource::collection($drugs), null, Response::HTTP_OK);
    }
}
