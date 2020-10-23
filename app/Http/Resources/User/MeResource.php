<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Address\UserAddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => UserAddressResource::collection($this->addresses),
            'token' => $this->token
        ];
    }
}
