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
            'image' => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            'activity_type' =>  $this->activity_name ? [
                'id' => $this->activity_type_id,
                'name' =>  $this->activity_name->find($this->activity_type_id)->name,
            ] : null,
            'name_company' => $this->name_company,
            'name_owner_company' => $this->name_owner_company,
            'national_identity' => $this->national_identity,
            'date' => $this->date,
            'city' => new CityResource($this->city_name),
            'region' => new RegionResource($this->region_name),
            'commercial_register_id' => $this->commercial_register_id,
            'file' => $this->file ? url('/storage') . '/' . $this->file : url('/product-no-img.jpg'),
        ];
    }
}
