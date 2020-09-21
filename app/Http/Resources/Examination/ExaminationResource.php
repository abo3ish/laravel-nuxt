<?php

namespace App\Http\Resources\Examination;

use App\Http\Traits\AdvertisementTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ExaminationResource extends JsonResource
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
            'icon' => $this->icon_url,
            'accept_multi' => $this->accept_multi,
            'services' => ExaminationServiceResource::collection($this->services()->where('parent_id', null)->get()),
            'ads' => $this->getPageAd($this->slug),
        ];
    }
}
