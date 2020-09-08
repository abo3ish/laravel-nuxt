<?php

namespace App\Http\Resources\Api\Cart;

use App\Models\Drug;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $drug = Drug::find($this->id);
        return [
            'row_id' => $this->rowId,
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->qty,
            'price' => $this->price * $this->qty,
            'description' => $drug->description,
            'image' => $this->id . ".png"
        ];
    }
}
