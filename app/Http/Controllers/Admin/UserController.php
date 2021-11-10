<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $userRepository;
    protected $activityTypeRepository;
    protected $regionRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ActivityTypeRepositoryInterface $activityTypeRepository,
        RegionRepositoryInterface $regionRepository,
        CityRepositoryInterface $cityRepository
    ) {
        $this->userRepository = $userRepository;
        $this->activityTypeRepository = $activityTypeRepository;
        $this->regionRepository = $regionRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $activities_type = $this->activityTypeRepository->getAll();
        $regions = $this->regionRepository->getAll();
        $cities = $this->cityRepository->getAll();
        return view('admin.users.create', compact('activities_type', 'regions', 'cities'));
    }
}
