<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'attribute_id'      => $this->id,
            'name'              => $this->name,
            'type'              => $this->type,
            'options'           => $this->options ? OptionResource::collection($this->options) : null,
            'min'               => $this->min,
            'max'               => $this->max,
            'step'              => $this->step,
        ];
    }
}
