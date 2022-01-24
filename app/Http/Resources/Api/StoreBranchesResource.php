<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreBranchesResource extends JsonResource
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
            'image' => url('/storage') . '/' .$this->image,
            'is_company_facility_agent' => $this->is_company_facility_agent,
            'is_company_facility_authorized_distributor' => $this->is_company_facility_authorized_distributor,
            'other_branches' => $this->other_branches,
            'company_sector_id' => $this->company_sector_id,
            'branches' => BranchResource::collection($this->branches)
        ];
    }
}
