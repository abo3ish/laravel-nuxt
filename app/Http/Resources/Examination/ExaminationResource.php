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
            'ads' => $this->getPageAd($this->slug),
            'status' => $this->status,
            'services' => ExaminationServiceResource::collection($this->services()->orderDisplay()->where('parent_id', null)->get())
        ];
    }
}
