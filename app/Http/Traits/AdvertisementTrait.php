<?php

namespace App\Http\Traits;

use App\Models\Advertisement;
use App\Http\Resources\Api\Advertisement\AdvertisementResource;

Trait AdvertisementTrait {
    function getPageAd($page) {
        $ads = Advertisement::active()->where('slug', $page)->get()->groupBy('position');
        if (isset($ads['top'])) {
            $ads['top'] = AdvertisementResource::collection($ads['top']);
        }
        if (isset($ads['bottom'])) {
            $ads['bottom'] = AdvertisementResource::collection($ads['bottom']);
        }
        if (isset($ads['full'])) {
            $ads['full'] = AdvertisementResource::collection($ads['full']);
        }
        return $ads;
    }
}
