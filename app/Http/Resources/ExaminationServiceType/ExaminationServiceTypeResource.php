<?php

namespace App\Http\Resources\ExaminationServiceType;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ExaminationServiceType\ExaminationServiceSubTypeResource;

class ExaminationServiceTypeResource extends JsonResource
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
            'examination_service_id' => $this->examination_service_id,
            'icon' => $this->icon,
            'sub_types' => $this->childs()->count() ? ExaminationServiceTypeResource::collection(collect($this->childs)) : [],
            'url' => ''
        ];
    }

}
