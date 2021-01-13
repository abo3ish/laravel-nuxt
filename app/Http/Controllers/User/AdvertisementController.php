<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiBaseController;
use App\Http\Traits\AdvertisementTrait;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends ApiBaseController
{
    use AdvertisementTrait;

    public function showSplashAd()
    {
        $ad['ads'] = $this->getPageAd('splash');
        $ad['ads']['home'] = $this->getPageAd('home');
        return apiReturn($ad);
    }
}
