<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Resources\Api\ProductDetailResource;
use App\Http\Resources\Api\StoreResource;

class ApiProductController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $ProductRepository;

    public function __construct(UserRepositoryInterface $userRepository, ProductRepositoryInterface $productRepository)
    {

        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateProductRequest $request)
    {

        $product = $this->productRepository->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
            'details' => $request->details,
            'seller_id' => auth()->user()->id
        ]);

        return $this->ApiResponse($product, 'Retrive Data success', 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findOne($id);
        if (!$product) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 422);
        }
        return $this->ApiResponse(new ProductDetailResource($product), null, 200);
    }


    public function getStoreProducts($id)
    {
        $store = $this->userRepository->findOne($id);
        if (!$store || !$store->hasRole('owner_store')) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 200);
        }
        $products  = new StoreResource($store);

        return $this->ApiResponse($products, null, 200);
    }
}
