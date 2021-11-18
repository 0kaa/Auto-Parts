<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CarResource;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\Request;

class ApiCarController extends Controller
{
    private $carRepository;
    use ApiResponseTrait;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index()
    {
        $cars = $this->carRepository->getAll();

        return $this->ApiResponse(CarResource::collection($cars), null, 200);
    }
}
