<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'order_status'          => new OrderStatusResource($this->order_status),
            "order_date"            => $this->created_at->format('l j F Y'),
            'order_time'            => $this->created_at->format('H:i a'),
            'order_ship_name'       => $this->order_ship_name,
            'order_ship_address'    => $this->order_ship_address,
            'order_ship_phone'      => $this->order_ship_phone,
            'payment_url'           => $this->payment_url,
            'payment'               => new PaymentMethodsResource($this->payment),
            'order_delivered_at'    => $this->order_delivered_at ? Carbon::parse($this->order_delivered_at)->format('l j F Y') : $this->order_delivered_at,
            'total_amount'          => $this->total_amount . ' SAR',
            'shipping_amount'       => 20 . ' SAR',
            'total'                 => $this->total_amount + 20 . ' SAR',
            'seller_name'           => $this->seller->name,
            'seller_activity_type'  => $this->seller->activity_name->name,
            'seller_region'         => $this->seller->region_name->name,
            'seller_city'           => $this->seller->city_name->name,
            'seller_commercial_register_id' => $this->seller->commercial_register_id,
            'seller_tokens'         => $this->seller->firebase_tokens->pluck('firebase_token')->toArray(),
            'user_tokens'           => auth()->user()->firebase_tokens->pluck('firebase_token')->toArray(),
            'products'              => OrderItemResource::collection($this->order_items),

        ];
    }
}
