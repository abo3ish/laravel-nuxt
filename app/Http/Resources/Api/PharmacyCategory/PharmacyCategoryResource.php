<?php

namespace App\Http\Resources\Api\PharmacyCategory;

use App\Models\Advertisement;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Advertisement\AdvertisementResource;

class PharmacyCategoryResource extends JsonResource
{
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
            'sub_categories' => $this->childs()->count() ? Self::collection(collect($this->childs)) : [],
            'ads' => AdvertisementResource::collection(Advertisement::where('slug', $this->slug)->get())
        ];
    }
}
