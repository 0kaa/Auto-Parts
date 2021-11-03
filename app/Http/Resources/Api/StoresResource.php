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
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            // 'badge' => $this->badge,
            'rating' => $this->rating,            
            'address' => $this->address,
            'activity_type' => $this->activity_name->select('name_ar','name_en','id')->find($this->activity_type_id),
        ];
    }
}
