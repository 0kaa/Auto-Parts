<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Resources\Api\ProductDetailResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\RatingResource;
use App\Http\Resources\Api\StoreResource;
use Illuminate\Support\Facades\DB;

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
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'description' => $request->get('description'),
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
        if (empty($product)) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 422);
        }
        return $this->ApiResponse(new ProductDetailResource($product), null, 200);
    }


    public function getStoreProducts($id)
    {
        $store = $this->userRepository->findOne($id);
        if (!$store) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 200);
        }
        $products  = new StoreResource($store);


        return $this->ApiResponse($products, null, 200);
    }

    public function createProductRating($id, Request $request)
    {
        $product = $this->productRepository->findOne($id);
        
        $user = auth()->user();
        $check_product_rate = $product->ratings->contains('user_id', $user->id);

        if (!$check_product_rate) {
            $product->ratings()->create([
                'user_id' => auth()->user()->id,
                'rating' => $request->get('rating'),
                'comment' => $request->get('comment')
            ]);

            return $this->ApiResponse(null, trans('local.rating_done'), 200);
        } else {
            $update_rating =  $product->ratings()->where([
                'user_id' => auth()->user()->id,
                'rateable_id' => $product->id,
            ])->first();

            $update_rating->update([
                'user_id' => auth()->user()->id,
                'rating' => $request->get('rating'),
                'comment' => $request->get('comment')
            ]);
            return $this->ApiResponse(null, trans('local.update_rating'), 200);
        }
    }
}
