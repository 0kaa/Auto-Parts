<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'question'          => $this->question,
            'answer'            => $this->answer,
            // 'created_at'        => $this->created_at->format('Y-m-d')
        ];
    }
}
