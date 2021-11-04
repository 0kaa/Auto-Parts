<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RatingResource;
use App\Repositories\RatingRepositoryInterface;
use Illuminate\Http\Request;

class ApiRatingController extends Controller
{

    use ApiResponseTrait;
    protected $ratingRepository;

    public function __construct(RatingRepositoryInterface $ratingRepository)
    {
        $this->ratingRepository  = $ratingRepository;
    }

    public function createProductRating(Request $request)
    {
        $user = $this->userRepository->findOne(16);
        // dd($product->ratings->avg('rating'));
        $user->ratings()->create([
            'user_id' => 16,
            'rating' => 1,
            'comment' => 'test message'
        ]);
    }
}
