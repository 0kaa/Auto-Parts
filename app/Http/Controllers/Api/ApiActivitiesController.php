<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\ActivityResource;
use App\Models\ActivityType;

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

        return $this->ApiResponse(['activites' => $activities_type], 'Retrive Data success', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return $this->ApiResponse(new ActivityResource($activities_type), 'test', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
