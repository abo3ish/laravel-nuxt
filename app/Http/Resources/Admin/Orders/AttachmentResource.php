<?php

namespace App\Http\Resources\Admin\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'size' => $this->size,
            'extension' => $this->extension,
            'mime' => $this->mime,
            'rowFile' => '',
        ];
    }

    // public function
}
