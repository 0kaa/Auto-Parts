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
            'price'         => $this->price . ' SAR',
            'order_status'  => new OrderStatusResource($this->customOrder->order_status),
            'created_at'    => $this->created_at->diffForHumans(),
            'message'       => __('local.user_price_offer') . ' ' . $this->price . ' SAR',
            'offers'        => PriceOfferItemsResource::collection($this->priceOfferItems),
            'seller'        => new StoresResource($this->seller),
        ];
    }
}
