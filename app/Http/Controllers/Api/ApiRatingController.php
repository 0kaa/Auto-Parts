<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiRatingController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $ProductRepository;

    public function __construct(UserRepositoryInterface $userRepository, ProductRepositoryInterface $productRepository)
    {
        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
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


    public function createStoreRating($id, Request $request)
    {
        $user = $this->userRepository->findOne($id);

        $user_id = auth()->user()->id;

        $check_user_rate = $user->ratings->contains('user_id', $user_id);

        if ($user->hasRole('owner_store')) {
            if (!$check_user_rate) {
                $user->ratings()->create([
                    'user_id' => $user_id,
                    'rating' => $request->rating,
                    'comment' => $request->comment
                ]);

                return $this->ApiResponse(null, trans('local.rating_done'), 200);
            } else {
                $update_rating =  $user->ratings()->where([
                    'user_id' => $user_id,
                    'rateable_id' => $user->id,
                ])->first();

                $update_rating->update([
                    'user_id' => $user_id,
                    'rating' => $request->rating,
                    'comment' => $request->comment
                ]);
                return $this->ApiResponse(null, trans('local.update_rating'), 200);
            }
        } else {
            return $this->ApiResponse(null, trans('errors.ratings_store'), 422);
        }
    }
}
