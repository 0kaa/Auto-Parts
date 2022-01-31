<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'order_status'          => $this->order_status->name,
            "order_date"            => $this->created_at->format('l j F Y'),
            'order_time'            => $this->created_at->format('H:i a'),
            'order_ship_name'       => $this->order_ship_name,
            'order_ship_address'    => $this->order_ship_address,
            'order_ship_phone'      => $this->order_ship_phone,
            'order_delivered_at'    => $this->order_delivered_at,
            'total_amount'          => $this->total_amount,
            'shipping_amount'       => 1,
            'total'                 => $this->total_amount + 1,
            'seller_name'           => $this->seller->name,
            'seller_activity_type'  => $this->seller->activity_name->name,
            'seller_region'         => $this->seller->region_name->name,
            'seller_city'           => $this->seller->city_name->name,
            'seller_commercial_register_id' => $this->seller->commercial_register_id,
            'products'              => OrderItemResource::collection($this->order_items),

        ];
    }
}
