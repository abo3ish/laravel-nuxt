<?php

namespace App\Http\Resources\Admin\Orders;

use App\Http\Resources\Admin\Orders\AttachmentResource;
use App\Http\Traits\Admin\ResourceTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowOrderResource extends JsonResource
{
    use ResourceTrait;
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
            'uuid' => $this->uuid,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'phone' => $this->user->phone,
            ],
            'address' => [
                'area' => $this->area ? $this->area->name : 'منطقة محذوفة',
                'street' => $this->street,
                'building_number' => $this->building_number,
                'floor_number' => $this->floor_number,
                'flat_number' => $this->flat_number,
                'lat' => $this->lat,
                'lng' => $this->lng,
            ],
            'area' => [
                'id' => $this->area_id,
                'name' => $this->area ? $this->area : 'منطقة محذوفة',
            ],
            'type' => $this->type,
            'services' => $this->getServiceOrderResource($this),
            'drugs' => $this->getDrugOrderResource($this),
            'attachments' => AttachmentResource::collection($this->attachments()->orderBy('type')->get()),
            'service_provider' => $this->serviceProvider ?? null,
            'status' => [
                'code' => $this->status,
                'string' => $this->status_string,
            ],
            'bill_cycle' => [
                'from' => $this->billCycle->from,
                'to' => $this->billCycle->to,
            ],
            'prices' => [
                'actual_price' => $this->actual_price,
                'discount_price' => $this->discount_price,
                'tax_price' => $this->tax_price,
                'delivery_price' => $this->delivery_price,
                'subtotal' => $this->subtotal,
                'price_to_pay' => $this->price_to_pay,
            ],
            'profits' => [
                'actual_profit' => $this->actual_profit,
                'company_profit' => $this->company_profit,
                'service_provider_profit' => $this->service_provider_profit,
                'profit_percentage' => $this->profit_percentage . "%",
            ],
            'is_collected' => $this->is_collected,
            'service_provider_type' => [
                'id' => $this->service_provider_type_id,
                'title' => $this->serviceProviderType ? $this->serviceProviderType->title : 'نوع مقدم خدمة محذوف',
            ],
            'dates' => [
                'created_at' => $this->created_at,
                'accepted_at' => $this->accepted_at,
                'arrived_at' => $this->arrived_at,
                'ended_at' => $this->ended_at,
                'canceled_at' => $this->canceled_at,
            ],
        ];
    }
}
