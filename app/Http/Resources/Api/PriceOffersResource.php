<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceOffersResource extends JsonResource
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
            'order_id'      => $this->customOrder->id,
            "piece_name"    => $this->customOrder->piece_name,
            "piece_image"   => $this->customOrder->piece_image ? url('/storage') . '/' . $this->customOrder->piece_image : url('/product-no-img.jpg'),
            'piece_price'   => $this->customOrder->piece_price ? $this->customOrder->piece_price . ' SAR' : null,
            'price'         => $this->price . ' SAR',
            'piece_name'    => $this->customOrder->piece_name,
            'message'       => __('local.user_price_offer') . ' ' . $this->price . ' SAR' . ' ' . __('local.for_service') . ' ' . $this->customOrder->piece_name,
            'created_at'    => $this->created_at->diffForHumans(),
            "note"          => $this->note,
            'seller'        => new StoresResource($this->seller),
        ];
    }
}
