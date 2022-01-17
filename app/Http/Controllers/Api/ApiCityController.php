<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Repositories\CityRepositoryInterface;
use Illuminate\Http\Request;

class ApiCityController extends Controller
{
    private $cityRepository;
    use ApiResponseTrait;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->getAll();

        return $this->ApiResponse(CityResource::collection($cities), null, 200);
    }
}
