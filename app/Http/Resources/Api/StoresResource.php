<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StoresResource extends JsonResource
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
            'image'         => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            'cover'         => $this->activity_name->cover ?  url('/storage') . '/' . $this->activity_name->cover : url('/product-no-img.jpg'),
            'name'          => $this->name_company,
            'badge'         => $this->package ? url('/storage') . '/' . $this->package->badge : null,
            'rating'        => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0,
            'address'       => $this->address,
            'is_fav'        => $this->isFav($this->id),
            "lat"           => $this->lat,
            "lng"           => $this->lng,
            'activity_type' => $this->activity_name ? $this->activity_name->find($this->activity_type_id)->name : null,
        ];
    }
}
