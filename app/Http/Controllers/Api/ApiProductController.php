<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\ProductDetailResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\RatingResource;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->ApiResponse(null, $validator->errors(), 422);
        }

        $product = $this->productRepository->create($request->all());

        return $this->ApiResponse($product, 'Retrive Data success', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findOne($id)->first();
        return $this->ApiResponse(new ProductDetailResource($product), null, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStoreProducts($id)
    {
        $store = $this->userRepository->findOne($id);

        $products  = new StoreResource($store);

        if ($store) {
            return $this->ApiResponse($products, null, 200);
        }
    }

    public function createProductRating($id, Request $request)
    {
        $product = $this->productRepository->findOne($id);

        $product->ratings()->create([
            'user_id' => auth()->user()->id,
            'rating' => $request->get('rating'),
            'comment' => $request->get('comment')
        ]);

        $this->productRepository->update(['rating' => $product->ratings()->avg('rating')], $id);

        return $this->ApiResponse(['rating_avg' => $product->ratings()->avg('rating')], trans('local.login_error'), 200);
    }
}
