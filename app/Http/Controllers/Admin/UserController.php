<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        $this->userRepository->create($request->all());

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->findOne($id);
        $activities_type = $this->activityTypeRepository->getAll();
        $regions = $this->regionRepository->getAll();
        $cities = $this->cityRepository->getAll();
        return view('admin.users.edit', compact('user', 'activities_type', 'regions', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findOne($id);

        $attributes = $request->except('_method', 'type_user', 'searchInput');

        if ($request->hasFile('image')) {
            Storage::delete($user->image);

            $attributes['image'] = $request->file('image')->store('user');
        }

        if ($request->hasFile('file')) {
            Storage::delete($user->file);

            $attributes['file'] = $request->file('file')->store('user');
        }

        if (!$request->password) {
            $attributes['password'] = $user->password;
        } else {
            $attributes['password'] =  bcrypt($request->password);
        }


        $user->update($attributes);
        // dd($user);
        $user->syncRoles([$request->type_user]);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.users')]), 200]);
    }
}
