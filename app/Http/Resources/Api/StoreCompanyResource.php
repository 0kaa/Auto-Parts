<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreCompanyResource extends JsonResource
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
            'image' => url('/') . '/' .$this->image,
            'activity_type' => $this->activity_name ? $this->activity_name->find($this->activity_type_id)->name : null,
            'name_company' => $this->name_company,
            'name_owner_company' => $this->name_owner_company,
            'national_identity' => $this->national_identity,
            'date' => $this->date,
            'city' => new CityResource($this->city_name),
            'region' => new RegionResource($this->region_name),
            'file' => url('/') . '/' .$this->file
        ];
    }
}
