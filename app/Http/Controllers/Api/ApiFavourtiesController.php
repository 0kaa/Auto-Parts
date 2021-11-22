<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\FavouriteResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\StoresResource;
use App\Models\Product;
use App\Models\User;
use App\Repositories\FavouriteRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;


class ApiFavourtiesController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $productRepository;
    protected $favouriteRepository;

    public function __construct(UserRepositoryInterface $userRepository, ProductRepositoryInterface $productRepository, FavouriteRepositoryInterface $favouriteRepository)
    {

        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
        $this->favouriteRepository  = $favouriteRepository;
    }

    public function index()
    {
        $user = auth()->user();

        $stores_favourites = $user->user_favourites()->where('favouriteable_type', 'App\Models\User')->get();

        $products_favourites = $user->user_favourites()->where('favouriteable_type', 'App\Models\Product')->get();

        return $this->ApiResponse(
            [
                'stores' => StoresResource::collection(User::whereIn('id', $stores_favourites->pluck('favouriteable_id')->toArray())->get()),
                'products' => ProductResource::collection(Product::whereIn('id', $products_favourites->pluck('favouriteable_id')->toArray())->get()),
            ],
            null,
            200
        );
    }

    public function createProductFavourtie($id)
    {

        $user_id = auth()->user()->id;

        $favourites_products = $this->productRepository->findOne($id);

        if (!$favourites_products) {
            return $this->ApiResponse(null, trans('local.no_product_found'), 404);
        }


        $check_product_favourite = $favourites_products->favourite->contains('user_id', $user_id);

        if (!$check_product_favourite) {

            $favourites_products->favourite()->create([
                'user_id' => $user_id
            ]);

            return $this->ApiResponse(null, trans('local.favourite_added'), 200);
        } else {
            $favourites_products->favourite()->delete([
                'user_id' => $user_id
            ]);

            return $this->ApiResponse(null, trans('local.favourite_removed'), 200);
        }
    }

    public function createStoreFavourtie($id)
    {

        $user_id = auth()->user()->id;

        $favourites_stores = $this->userRepository->findOne($id);

        if (!$favourites_stores) {
            return $this->ApiResponse(null, trans('errors.user_not_found'), 404);
        }

        $check_product_favourite = $favourites_stores->favourite->contains('user_id', $user_id);


        if ($favourites_stores->hasRole('owner_store')) {
            if (!$check_product_favourite) {

                $favourites_stores->favourite()->create([
                    'user_id' => $user_id
                ]);

                return $this->ApiResponse(null, trans('local.favourite_added'), 200);
            } else {

                $favourites_stores->favourite()->delete([
                    'user_id' => $user_id
                ]);

                return $this->ApiResponse(null, trans('local.favourite_removed'), 200);
            }
        } else {
            return $this->ApiResponse(null, trans('errors.favourite'), 422);
        }
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
        //
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
}
