<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomOrderResource extends JsonResource
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
            "order_status"          => $this->order_status,
            "activity_type_id"      => $this->activityType->id,
            "activity_type_name"    => $this->activityType->name,
            "sup_activity_id"       => $this->supActivity->id,
            "sup_activity_name"     => $this->supActivity->name,
            "piece_name"            => $this->piece_name,
            "piece_image"           => $this->piece_image,
            "piece_price"           => $this->piece_price,
            "car"                   => $this->car->name,
            "order_data"            => $this->order_data,
            "seller"                => new StoresResource($this->seller),
            "user"                  => new UserResource($this->user),

        ];
    }
}
