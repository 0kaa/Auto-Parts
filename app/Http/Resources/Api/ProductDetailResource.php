<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? url('/storage') . '/' . $this->image : null,
            'price' => $this->price,
            'description' => $this->description,            
            'rating' => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0,
            'comments_count' => count($this->ratings),
            'seller_id' => $this->seller->id,
            'seller_name' => $this->seller->name_owner_company,
            'seller_rating' => $this->seller->ratings()->avg('rating') ? $this->seller->ratings()->avg('rating') : 0,
            'seller_image' => url('/storage') . '/' . $this->seller->image,
            'store_name' => $this->seller->name_company,
            'features' => $this->features,
            'details' => $this->details,
            'ratings' => RatingResource::collection($this->ratings),
        ];
    }
}
