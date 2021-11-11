<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\ActivityResource;

class ApiActivitiesController extends Controller
{

    use ApiResponseTrait;
    protected $activityTypeRepository;
    protected $userRepository;

    public function __construct(ActivityTypeRepositoryInterface $activityTypeRepository, UserRepositoryInterface $userRepository)
    {

        $this->activityTypeRepository  = $activityTypeRepository;
        $this->userRepository  = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities_type = $this->activityTypeRepository->getAll();
        return $this->ApiResponse(ActivityResource::collection($activities_type), null, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities_type =  $this->activityTypeRepository->findOne($id);

        return $this->ApiResponse(new ActivityResource($activities_type), null, 200);
    }
    
}
