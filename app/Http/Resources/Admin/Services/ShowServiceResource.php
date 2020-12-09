<?php

namespace App\Http\Resources\Admin\Services;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowServiceResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon_url,
            'service_provider_type_id' => $this->service_provider_type_id,
            'estimation_from' => $this->estimation_from,
            'estimation_to' => $this->estimation_to,
            'price' => $this->price,
            'display_order' => $this->display_order,
            'examination_id' => $this->examination_id,
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'status' => $this->status,
        ];
    }
}
