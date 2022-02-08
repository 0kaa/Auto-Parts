<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'id'            => $this->id,
            'rating'        => $this->rating,
            'comment'       => $this->comment,
            'user_id'       => $this->user->id,
            'user_name'     => $this->user->name,
            'user_image'    => $this->user->image ? url('/storage') . '/' . $this->user->image : null,            
            "created_at"    => $this->updated_at->diffForHumans(),
        ];
    }
}
