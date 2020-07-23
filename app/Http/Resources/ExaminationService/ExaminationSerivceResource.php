<?php

namespace App\Http\Resources\ExaminationService;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ExaminationServiceType\ExaminationServiceTypeResource;

class ExaminationSerivceResource extends JsonResource
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
            'types' => ExaminationServiceTypeResource::collection($this->examinationServiceTypes()->where('parent_id', null)->get())
        ];
    }
}
