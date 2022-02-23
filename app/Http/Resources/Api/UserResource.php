<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            'name'          => $this->name,
            "email"         => $this->email,
            "phone"         => $this->phone,
            "address"       => $this->address,
            'name_company'  => $this->name_company,
            'name_owner_company'  => $this->name_owner_company,
            "lat"           => $this->lat,
            "lng"           => $this->lng,
            'is_notify'     => $this->is_notify,
            "image"         => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            "created_at"    => $this->created_at->format('Y-m-d'),
            'type'          => $this->roles->pluck('name')->first(),
            'approved'      => $this->approved,
        ];
    }
}
