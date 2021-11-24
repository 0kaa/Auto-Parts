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
            'id'            => $this->id,
            'order_number'      => $this->order_number,
            'total_count'   => $this->order_items->sum('quantity'),
            'total_amount'  => $this->total_amount,
            'order_name'    => $this->order_items->first()->product->name,
            'order_status'  => $this->order_status,
            "order_date"    => $this->created_at->format('l j F Y'),
            'order_time'    => $this->created_at->format('H:i a'),
            'order_address' => $this->order_address,
            'products'      => OrderItemResource::collection($this->order_items),
        ];
    }
}
