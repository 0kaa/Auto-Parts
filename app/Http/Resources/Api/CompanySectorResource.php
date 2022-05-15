<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanySectorResource extends JsonResource
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
            'name' => $this->company->name,
            'image' => $this->company->image ? url('/storage') . '/' . $this->company->image : url('/product-no-img.jpg'),
            'models'    => $this->company->models ? CompanyModelResource::collection($this->company->models) : [],
        ];
    }
}
