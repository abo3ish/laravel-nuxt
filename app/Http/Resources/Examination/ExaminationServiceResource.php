<?php

namespace App\Http\Resources\Examination;

use Illuminate\Http\Resources\Json\JsonResource;

class ExaminationServiceResource extends JsonResource
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
            'examination_id' => $this->examination_id,
            'icon' => $this->icon_url,
            'sub_services' => $this->childs()->count() ? Self::collection(collect($this->childs)) : [],
            // 'url' => '',
            'estmation_from' => $this->estimation_from,
            'estimation_to' => $this->estimation_to
        ];
    }
}
