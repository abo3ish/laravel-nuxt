<?php

namespace App\Http\Resources\Admin\Services;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'icon' => $this->icon_url,
            'service_provider_type' => [
                'id' => $this->service_provider_type_id,
                'title' => $this->serviceProviderType ? $this->serviceProviderType->title : 'نوع مقدم خدمة محذوف',
            ],
            'examination' => [
                'id' => $this->examination_id,
                'title' => $this->examination ? $this->examination->title : 'فحص محذوف',
            ],
            'parent' => $this->parent_id && $this->parent ?
                     [
                        "id" => $this->parent_id,
                        "title" => $this->parent->title
                    ] : null,
            'slug' => $this->slug,
            'status' => $this->status,
        ];
    }
}
