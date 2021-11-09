<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductPaginationResource extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($product) {
                return new ProductResource($product);
            }),

            "links" => [
                "prev" => $this->previousPageUrl(),
                "next" => $this->nextPageUrl(),
            ],

            "meta" => [
                "current_page" => $this->currentPage(),
                "from" => $this->firstItem(),
                "to" => $this->lastItem(),
                "last_page" => $this->lastPage(), // not For Simple
                "per_page" => $this->perPage(),
                'count' => $this->count(), //count of items at current page
                "total" => $this->total() // not For Simple
            ]
        ];
    }
}
