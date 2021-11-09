<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Repositories\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //

    protected $cityRepository;
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->getAll();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(CityRequest $request)
    {
        $this->cityRepository->create($request->all());
        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.region')]), 200]);
    }

    public function edit($id)
    {
        $city = $this->cityRepository->findOne($id);
        return view('admin.cities.create', compact('city'));
    }

    public function update($id, CityRequest $request)
    {
        $this->cityRepository->update($request->except('_method'), $id);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.region')]), 200]);
    }

    public function destroy($id)
    {
        $this->cityRepository->delete($id);
        return response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
