<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomOrderDetailsResource extends JsonResource
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
            "id"                    => $this->id,
            "user_id"               => $this->user->id,
            "user_name"             => $this->user->name,
            "user_email"            => $this->user->email,
            "user_phone"            => $this->user->phone,
            "user_address"          => $this->user->address,
            'order_status'          => new OrderStatusResource($this->order_status),
            'order_items'           => CustomOrderItemResource::collection($this->custom_order_items),
        ];
    }
}
