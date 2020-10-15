<?php

namespace App\Http\Controllers\User;

use App\Models\Drug;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\PharmacyCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Drug\DrugResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\Api\PharmacyCategory\PharmacyCategoryResource;
use App\Http\Traits\AdvertisementTrait;

class PharmacyCategoryController extends ApiBaseController
{
    use AdvertisementTrait;

    public function index()
    {
        $categories = PharmacyCategory::where('status', 1)->where('parent_id', null)->get();
        $data['categories'] = PharmacyCategoryResource::collection($categories);
        $data['ads'] = $this->getPageAd('pharmacy-category');
        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function show(PharmacyCategory $pharmacyCategory)
    {
        // $drugs = Drug::where('category_id', $pharmacyCategory->id)->paginate(20);

        $drugs = $pharmacyCategory->drugs()->paginate(20);
        $data = DrugResource::collection($drugs);
        $data = customPagination($data, 'drugs');
        return apiReturn($data, null, Response::HTTP_OK);
    }

    public function subCategories(PharmacyCategory $pharmacyCategory)
    {
        $categories = PharmacyCategory::where('status', 1)->where('parent_id', $pharmacyCategory->id)->get();
        $data['categories'] = PharmacyCategoryResource::collection($categories);
        $data['ads'] = $this->getPageAd('pharmacy-category');
        return apiReturn($data, null, Response::HTTP_OK);
    }
}
