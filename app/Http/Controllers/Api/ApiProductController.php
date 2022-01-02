<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Resources\Api\ProductDetailResource;
use App\Http\Resources\Api\StoreProductsResource;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $ProductRepository;
    protected $filesServices;

    private $productDirectory = 'products';

    public function __construct(UserRepositoryInterface $userRepository, ProductRepositoryInterface $productRepository, UploadFilesServices $filesServices)
    {

        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
        $this->filesServices = $filesServices;
    }

    public function create(CreateProductRequest $request)
    {
        $image = 'product-no-img.jpg';

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->productDirectory);
        }

        $product = $this->productRepository->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'features' => $request->features,
            'details' => $request->details,
            'image' => $image,
            'seller_id' => auth()->user()->id
        ]);

        return $this->ApiResponse($product, 'Retrive Data success', 200);
    }

    public function show($id)
    {
        $product = $this->productRepository->findOne($id);
        if (!$product) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 422);
        }
        return $this->ApiResponse(new ProductDetailResource($product), null, 200);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->findOne($id);

        if (!$product || $product->seller_id != auth()->user()->id) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 404);
        }

        $image = $product->image;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            Storage::delete($product->image);
            $image = $this->filesServices->uploadfile($img, $this->productDirectory);
        }

        $product->update([
            'image'         => $image,
            'name'          => $request->name ? $request->name : $product->name,
            'price'         => $request->price ? $request->price : $product->price,
            'description'   => $request->description ? $request->description : $product->description,
            'features'      => $request->features ? $request->features : $product->features,
            'details'       => $request->details ? $request->details : $product->details,
        ]);

        $product->save();

        return $this->ApiResponse(null, trans('local.product_updated'), 200);
    }

    public function delete($id)
    {
        $product = $this->productRepository->findOne($id);

        if (!$product || $product->seller_id != auth()->user()->id) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 404);
        }

        if (isset($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return $this->ApiResponse(null, trans('local.product_deleted'), 200);
    }

    public function getStoreProducts($id)
    {
        $store = $this->userRepository->findOne($id);
        if (!$store || !$store->hasRole('owner_store')) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 200);
        }
        $products  = new StoreProductsResource($store);

        return $this->ApiResponse($products, null, 200);
    }
}
