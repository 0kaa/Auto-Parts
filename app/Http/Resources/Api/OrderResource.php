<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number'          => $this->order_number,
            'total_count'           => $this->order_items->sum('quantity'),
            'total_amount'          => $this->total_amount . ' SAR',
            'order_name'            => $this->order_items->first()->product->name,
            'payment_url'           => $this->payment_url,
            'order_status'          => $this->order_status->name,
            "time"                  => $this->created_at->format('H:i a'),
            'date'                  => $this->created_at->format('Y-m-d'),
            'order_delivered_at'    => $this->order_delivered_at ? $this->order_delivered_at->format('l j F Y') : $this->order_delivered_at,
            'order_ship_name'       => $this->order_ship_name,
            'order_ship_address'    => $this->order_ship_address,
            'order_ship_phone'      => $this->order_ship_phone,
            'shipping'              => new ShippingResource($this->shipping),
            'payment'               => new PaymentMethodsResource($this->payment),
        ];
    }
}
