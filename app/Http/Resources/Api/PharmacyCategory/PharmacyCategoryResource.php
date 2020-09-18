<?php

namespace App\Http\Resources\Api\PharmacyCategory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Traits\AdvertisementTrait;

class PharmacyCategoryResource extends JsonResource
{
    use AdvertisementTrait;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'url' => $this->childs()->count() ? '' : route('pharmacy-categories.show', $this->id),
            'slug' => $this->slug,
            // 'sub_categories' => $this->childs()->count() ? Self::collection(collect($this->childs)) : [],
            'ads' =>  $this->getPageAd($this->slug)
        ];
    }
}
