<?php

namespace App\Http\Resources\Admin\Drug;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'name' => Str::limit($this->name, 20, '...'),
            'scientific_name' => Str::limit($this->scientific_name, 20, '...'),
            'image' => $this->image_url,
            'price' => $this->price,
            'category' => [
                'id' => $this->category->id,
                'title' => $this->category ? $this->category->title : 'قسم محذوف',
            ],
        ];
    }
}
