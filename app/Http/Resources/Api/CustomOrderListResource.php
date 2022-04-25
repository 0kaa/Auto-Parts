<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomOrderListResource extends JsonResource
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
            'order_number'          => '#' . strval($this->id),
            'order_status'          => $this->order_status->name,
            "time"                  => $this->created_at->format('H:i a'),
            'date'                  => $this->created_at->format('Y-m-d'),
            'piece_name'            => $this->custom_order_items->first() ? $this->custom_order_items->first()->piece_name : null,
            'quantity'              => count($this->custom_order_items),
        ];
    }
}
