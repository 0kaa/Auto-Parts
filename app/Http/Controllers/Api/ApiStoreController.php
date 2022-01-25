<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Http\Resources\Api\ActivityResource;
use App\Http\Resources\Api\StoreResource;
use App\Http\Resources\Api\StoresResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiStoreController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $activityTypeRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ActivityTypeRepositoryInterface $activityTypeRepository
    ) {

        $this->userRepository  = $userRepository;
        $this->activityTypeRepository = $activityTypeRepository;
    }


    public function getStoresList()
    {
        $stores = $this->userRepository->user_role('owner_store');

        return $this->ApiResponse(StoresResource::collection($stores), null, 200);
    }

    public function getStore($id)
    {

        $store = $this->userRepository->findOne($id);

        if ($store && $store->hasRole('owner_store')) {
            return $this->ApiResponse(new StoreResource($store), null, 200);
        }

        return $this->ApiResponse(null, trans('local.store_not_found'), 401);
    }


    public function getStoresInMyActivity($id)
    {
        $user = auth()->user();

        $activities_type =  $this->activityTypeRepository->findOne($id);

        if (!$activities_type) {
            return $this->ApiResponse(null, trans('local.activity_id_not_found'), 404);
        }

        $myActivities = $user->activities->pluck('activity_type_id')->toArray();

        if (!in_array($id, $myActivities)) {
            return $this->ApiResponse(null, trans('local.you_are_not_registered_in_this_activity_type'), 404);
        }



        return $this->ApiResponse(new ActivityResource($activities_type), null, 200);
    }
}
