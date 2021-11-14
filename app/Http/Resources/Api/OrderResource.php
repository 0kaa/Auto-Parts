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
            'id'            => $this->id,
            'order_name'    => $this->order_items->first()->product->name,
            'order_status'  => $this->order_status,
            'order_date'    => $this->order_date,
            'order_time'    => $this->order_time,
            "created_at"    => $this->created_at->diffForHumans(),
            'grand_total'   => $this->grand_total,
            'order_address' => $this->order_address,
            'products'      => OrderItemResource::collection($this->order_items),
        ];
    }
}
