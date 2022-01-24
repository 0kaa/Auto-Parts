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
        foreach ($this->branches as $key => $branch) {
            $branches[] = [
                'branch_num' => __('local.branch_' . $key),
                'region' => new RegionResource($branch->region),
                'city' => new CityResource($branch->city),
                'phone' => $branch->phone,
                'address' => $branch->address,
            ];
        }
        return [
            'id' => $this->id,
            'image' => url('/storage') . '/' . $this->image,
            'is_company_facility_agent' => $this->is_company_facility_agent,
            'is_company_facility_authorized_distributor' => $this->is_company_facility_authorized_distributor,
            'other_branches' => $this->other_branches,
            'company' => $this->company_sector->name,
            'branches' => $branches
        ];
    }
}
