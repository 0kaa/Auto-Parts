<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\SubActivityTypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\ActivitiesResource;
use App\Http\Resources\Api\ActivityResource;
use App\Http\Resources\Api\SubActivitiesResource;

class ApiActivitiesController extends Controller
{

    use ApiResponseTrait;
    protected $activityTypeRepository;
    protected $subActivityTypeRepository;
    protected $userRepository;

    public function __construct(
        ActivityTypeRepositoryInterface $activityTypeRepository,
        SubActivityTypeRepositoryInterface $subActivityTypeRepository,
        UserRepositoryInterface $userRepository
    ) {

        $this->activityTypeRepository  = $activityTypeRepository;
        $this->subActivityTypeRepository = $subActivityTypeRepository;
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
        return $this->ApiResponse(ActivitiesResource::collection($activities_type), null, 200);
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
        $user = auth()->user();

        dd($user);

        return $this->ApiResponse(new ActivityResource($activities_type), null, 200);
    }

    public function getSubActivities($id)
    {
        $sub_activities_type = $this->subActivityTypeRepository->getWhere(['activity_type_id' => $id]);
        return $this->ApiResponse(SubActivitiesResource::collection($sub_activities_type), null, 200);
    }
}
