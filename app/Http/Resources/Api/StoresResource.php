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
            'image'         => $this->image,
            'name'          => $this->name,
            'badge'         => $this->package ? $this->package->badge : null,
            'rating'        => $this->ratings()->avg('rating'),
            'address'       => $this->address,
            "lat"           => $this->lat,
            "lng"           => $this->lng,
            'activity_type' => $this->activity_name ? $this->activity_name->find($this->activity_type_id)->name : null,
        ];
    }
}
