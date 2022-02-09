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
            "order_status"          => $this->order_status,
            "activity_type_id"      => $this->activityType->id,
            "activity_type_name"    => $this->activityType->name,
            "sub_activity_id"       => $this->subActivity->id,
            "sub_activity_name"     => $this->subActivity->name,
            "piece_name"            => $this->piece_name,
            "piece_image"           => url('/') . '/' . $this->piece_image,
            "piece_description"     => $this->piece_description,
            'piece_price'           => $this->piece_price,
            'form_image'            => url('/') . '/' . $this->form_image,
            "car"                   => $this->car->name,
            'attributes'            => $this->attributes->map(function ($attribute) {
                return [
                    'id'                => $attribute->id,
                    'attribute_name'    => $attribute->attribute->name,
                    'value'             => $attribute->attribute->type == 'text' ||  $attribute->attribute->type == 'file' ? $attribute->value : $attribute->option->name,
                ];
            }),
        ];
    }
}
