<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RegionResource;
use App\Repositories\RegionRepositoryInterface;
use Illuminate\Http\Request;

class ApiRegionController extends Controller
{
    private $regionRepository;
    use ApiResponseTrait;

    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function index()
    {
        $cities = $this->regionRepository->getAll();

        return $this->ApiResponse(RegionResource::collection($cities), null, 200);
    }
}
