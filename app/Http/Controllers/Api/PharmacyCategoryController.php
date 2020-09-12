<?php

namespace App\Http\Controllers\Api;

use App\Models\Drug;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\PharmacyCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Drug\DrugResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Resources\Api\Advertisement\AdvertisementResource;
use App\Http\Resources\Api\PharmacyCategory\PharmacyCategoryResource;

class PharmacyCategoryController extends ApiBaseController
{
    public function index()
    {
        $categories = PharmacyCategory::where('status', 1)->where('parent_id', null)->get();
        $data['categories'] = PharmacyCategoryResource::collection($categories);
        $data['ads'] = AdvertisementResource::collection(Advertisement::where('slug', 'pharmacy-category')->get());
        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function show(PharmacyCategory $pharmacyCategory)
    {
        $drugs = Drug::where('category_id', $pharmacyCategory->id)->paginate(20);
        $data = DrugResource::collection($drugs);

        $data = [
            'drugs' => $data->items(),
            'pagination' => [
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'next_page_url' => $data->nextPageUrl(),
                'previous_page_url' => $data->previousPageUrl(),
                'first_item' => $data->firstItem(),
                'last_item' => $data->lastItem(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ]
        ];
        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function subCategories(PharmacyCategory $pharmacyCategory)
    {
        $categories = PharmacyCategory::where('status', 1)->where('parent_id', $pharmacyCategory->id)->get();
        $data['categories'] = PharmacyCategoryResource::collection($categories);
        $data['ads'] = AdvertisementResource::collection(Advertisement::where('slug', 'pharmacy-category')->get());
        return apiReturn($data, null, Response::HTTP_OK);
    }
}
