<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ShippingResource;
use App\Repositories\ShippingRepositoryInterface;
use Illuminate\Http\Request;


class ApiShippingController extends Controller
{
    use ApiResponseTrait;
    private $shippingRepository;

    public function __construct(ShippingRepositoryInterface $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    public function index()
    {
        $shippings = $this->shippingRepository->getAll();
        
        return $this->ApiResponse(ShippingResource::collection($shippings), null, 200);
    }
}
