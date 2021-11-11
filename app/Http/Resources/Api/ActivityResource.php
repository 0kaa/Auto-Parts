<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'name' => $this->name,         
            'type' => $this->type,
            'image' => $this->image,
            // 'created_at' => $this->created_at->format('Y-m-d'),
            'stores' => StoresResource::collection($this->store),
            'parents' => $this->parents,
        ];
    }
}
