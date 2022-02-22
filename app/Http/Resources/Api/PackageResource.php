<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'id'                    => $this->id,
            'name'                  => $this->name,
            'description'           => $this->description,
            'duration'              => $this->duration,
            'keyword'               => $this->keyword,
            'badge'                 => url('/storage') . '/' . $this->badge,
            'price'                 => $this->price . ' SAR',
            'discount'              => $this->discount . ' SAR',
            'price_after_discount'  => $this->price + 0 - $this->discount + 0 . ' SAR',
            'features'              => $this->features,
        ];
    }
}
