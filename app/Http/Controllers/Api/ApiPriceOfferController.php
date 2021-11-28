<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\PriceOfferRepositoryInterface;
use Illuminate\Http\Request;

class ApiPriceOfferController extends Controller
{
    use ApiResponseTrait;
    private $priceOfferRepository;

    public function __construct(PriceOfferRepositoryInterface $priceOfferRepository)
    {
        $this->priceOfferRepository = $priceOfferRepository;
    }

    public function index()
    {
        $priceOffers = $this->priceOfferRepository->getWhere([['seller_id' =>  auth()->user()->id]])->get();

        return $this->ApiResponse($priceOffers, null, 200);
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

         $this->priceOfferRepository->create([
            'seller_id'         => auth()->user()->id,
            'custom_order_id'   => $attributes['custom_order_id'],
            'price'             => $attributes['price'],
            'note'              => $attributes['note'],
            'status'            => 'pending',

        ]);
    
        return $this->ApiResponse(null, 'Price offer created', 200);

    }
}
