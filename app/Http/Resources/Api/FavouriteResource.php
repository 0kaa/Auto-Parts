<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->user);
        return [
            'stores' => StoresResource::collection($this->users),
            'products' => ProductResource::collection($this->products),
            // 'products' => ProductResource::collection(Product::whereIn('id', $products_favourites->pluck('favouriteable_id')->toArray())->get()),
        ];
    }
}
