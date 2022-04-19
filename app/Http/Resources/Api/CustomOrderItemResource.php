<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomOrderItemResource extends JsonResource
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
            'order_number'          => strval($this->id),
            'piece_name'            => $this->piece_name,
            'piece_image'           => $this->piece_image ? url('storage/' . $this->piece_image) : url('/product-no-img.jpg'),
            'car_name'              => $this->car->name,
            'car_image'             => $this->car->image ? url('storage/' . $this->car->image) : url('/product-no-img.jpg'),
            'piece_description'     => $this->piece_description,
            'quantity'              => $this->quantity,
            "activity_type_id"      => $this->activityType->id,
            "activity_type_name"    => $this->activityType->name,
            "sub_activity_id"       => $this->subActivity->id,
            "sub_activity_name"     => $this->subActivity->name,
            "piece_name"            => $this->piece_name,
            "piece_image"           => $this->piece_image ? url('/storage') . '/' . $this->piece_image : url('/product-no-img.jpg'),
            "piece_description"     => $this->piece_description,
            'piece_price'           => $this->piece_price ? $this->piece_price . ' SAR' : null,
            'form_image'            => $this->form_image ? url('/storage') . '/' . $this->form_image : $this->form_image,
            'attributes'            => $this->attributes->map(function ($attribute) {
                return [
                    'id'                => $attribute->id,
                    'attribute_name'    => $attribute->attribute->name,
                    'attribute_type'    => $attribute->attribute->type,
                    'value'             => $attribute->attribute->type == 'select' ?  $attribute->option->name : ($attribute->attribute->type == 'file' ? url('/storage') . '/' . $attribute->value : $attribute->value),
                ];
            }),
        ];
    }
}
