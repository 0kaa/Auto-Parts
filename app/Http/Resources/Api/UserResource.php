<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            "id" => $this->id,
            "email" => $this->email,
            "phone" => $this->phone,
            "address" => $this->address,
            "verification_code" => $this->verification_code,
            "approved" => $this->approved,
            "type" => $this->type,
            "email_verified_at" => $this->email_verified_at,
            "image" => $this->image,
            "name_company" => $this->name_company,
            "name_owner_company" => $this->name_owner_company,
            "national_identity" => $this->national_identity,
            "date" => $this->date,
            "file" => $this->file,
            "ibn" => $this->ibn,
            "city" => $this->city,
            "is_company_facility_agent" => $this->is_company_facility_agent,
            "is_company_facility_authorized_distributor" => $this->is_company_facility_authorized_distributor,
            "other_branches" => $this->other_branches,
            "created_at" => $this->created_at->format('Y-m-d'),
            "activity_type_id" => $this->activity_type_id,
            "region_id" => $this->region_id,
            "company_sector_id" => $this->company_sector_id,
        ];
    }
}
