<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'id'                        => $this->id,
            'name'                      => $this->name,
            'activity_type'             => $this->activity_name ? $this->activity_name->name : null,
            'region'                    => $this->region_name ? $this->region_name->name : null,
            'city'                      => $this->city_name ? $this->city_name->name : null,
            'commercial_register_id'    => $this->commercial_register_id,
        ];
    }
}
