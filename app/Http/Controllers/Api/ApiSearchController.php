<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Api\Traits\Searching;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchRequest;
use App\Http\Resources\Api\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiSearchController extends Controller
{
    use Searching;
    use ApiResponseTrait;

    public function search(SearchRequest $request)

    {

        $search_type = $request->search_type;

        if ($search_type == 'product') {
            $searchResultsInProduct = $this->AdvanceSearch(new Product(), ['keyword' => 'keyword',], request());

            if ($searchResultsInProduct->count() > 0) {

                $searchResultsInProduct = ProductResource::collection($searchResultsInProduct);

                return $this->ApiResponse($searchResultsInProduct, trans('validation.attributes.search'), 200);
            } else {
                return $this->ApiResponse([], trans('local.search_empty'), 404);
            }
        }

        // Holding to create orders models

        if ($search_type == 'order') {
            $searchResultsInOrder = $this->AdvanceSearch(new Order(), ['keyword' => 'keyword',], request());

            $searchResultsInOrder = ProductResource::collection($searchResultsInOrder);

            return $this->ApiResponse($searchResultsInOrder, trans('validation.attributes.search'), 200);
        }

    }
}
