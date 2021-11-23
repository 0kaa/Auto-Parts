<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PackageResource;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Http\Request;

class ApiPackagesController extends Controller
{
    use ApiResponseTrait;
    private $packageRepository;
    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        // all packages
        $packages = $this->packageRepository->getAll();

        return $this->ApiResponse(PackageResource::collection($packages), null, 200);
    }
}
