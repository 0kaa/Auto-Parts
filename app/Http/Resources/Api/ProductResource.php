<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class ProductResource extends JsonResource
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
            'price' => $this->price . 'SAR',
            // get image with full url of project
            'is_fav'        => $this->isFav($this->id),
            'image' => url('/storage') . '/' . $this->image,
            'rating' => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0
        ];
    }
}
