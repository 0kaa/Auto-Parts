<?php

namespace App\Http\Resources\Api;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id'        => $this->id,
            'time'      => $this->created_at ? $this->created_at->diffForHumans() : null,
            'read_at'   => $this->read_at ? $this->read_at->diffForHumans() : null,
            'readed'    => $this->read_at ? true : false,
            'message'   => $this->message,
            'type'      => $this->type,
            'user_id'   => $this->user_id,
            'model_id'  => $this->model_id

        ];
    }
}
