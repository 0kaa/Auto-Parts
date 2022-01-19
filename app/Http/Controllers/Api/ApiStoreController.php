<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StoreResource;
use App\Http\Resources\Api\StoresResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiStoreController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository  = $userRepository;
    }


    public function getStoresList()
    {
        $stores = $this->userRepository->user_role('owner_store');

        return $this->ApiResponse(StoresResource::collection($stores), null, 200);
    }

    public function getStore($id)
    {

        $store = $this->userRepository->findOne($id);
        dd($store->role);
        if ($store->user_role != 'owner_store') {
            return $this->ApiResponse(null, 'You are not owner of this store', 401);
        }

        return $this->ApiResponse(new StoreResource($store), null, 200);
    }
}
