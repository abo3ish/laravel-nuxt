<?php

namespace App\Http\Resources\Api\Drug;

use Illuminate\Http\Resources\Json\JsonResource;

class DrugResource extends JsonResource
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
            'name' => $this->name,
            // 'scientific_name' => $this->scientific_name,
            'description' => $this->description,
            'image' => $this->image_url,
            'price' => $this->price,
        ];
    }
}
