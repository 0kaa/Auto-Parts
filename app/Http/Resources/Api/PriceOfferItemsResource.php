<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceOfferItemsResource extends JsonResource
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
            'order_id'      => $this->customOrderItem->id,
            "piece_name"    => $this->customOrderItem->piece_name,
            "piece_image"   => $this->customOrderItem->piece_image ? url('/storage') . '/' . $this->customOrderItem->piece_image : url('/product-no-img.jpg'),
            'piece_price'   => $this->price ? $this->price . ' SAR' : null,
            'piece_name'    => $this->customOrderItem->piece_name,            
        ];
    }
}
