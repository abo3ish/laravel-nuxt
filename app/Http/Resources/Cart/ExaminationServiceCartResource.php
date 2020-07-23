<?php

namespace App\Http\Resources\Cart;

use App\Models\ExaminationServiceType;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class ExaminationServiceCartResource extends JsonResource
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
            'rowId' => $this->rowId,
            'title' => $this->name,
            'qty' => $this->qty,
            'price' => $this->price,
            'discount' => $this->discount ?? 0,
            'subtotal' => $this->subtotal,
        ];
    }

    public function getSubTotal()
    {
        return Cart::instance(auth()->id())->subtotal();
    }
}
