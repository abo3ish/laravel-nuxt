<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class EditUserResource extends JsonResource
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
            'status' => $this->status,
            'channel' => $this->channel,
            'push_token_type' => $this->push_token_type,
            'push_token' => $this->push_token,
            'social_provider' => $this->social_provider,
            'social_id' => $this->social_id,
            'addresses' => $this->addresses->load('area')
        ];
    }
}
