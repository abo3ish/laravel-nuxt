<?php

namespace App\Http\Resources\Admin\Examinations;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowExaminationResource extends JsonResource
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
            'display_order' => $this->display_order,
            'slug' => $this->slug,
            'accept_multi' => $this->accept_multi,
            'status' => $this->status,
        ];
    }
}
