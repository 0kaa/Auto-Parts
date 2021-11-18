<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    //

    protected $carRepository;
    protected $filesServices;

    private $carDirectory = 'cars';

    public function __construct(carRepositoryInterface $carRepository, UploadFilesServices $filesServices)
    {
        $this->carRepository = $carRepository;
        $this->filesServices = $filesServices;
    }

    public function index()
    {
        $cars = $this->carRepository->getAll();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->carDirectory);
        }

        $this->carRepository->create(array_merge($request->except('image'), ['image' => $image]));

        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.car')]), 200]);
    }

    public function edit($id)
    {
        $car = $this->carRepository->findOne($id);
        return view('admin.cars.create', compact('car'));
    }

    public function update($id, Request $request)
    {
        $car = $this->carRepository->findOne($id);

        $image = $car->image;

        if ($request->hasFile('image')) {
            Storage::delete($car->image);

            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->carDirectory);
        }

        $this->carRepository->update(array_merge($request->except('_method', 'image'), ['image' => $image]), $id);

        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.car')]), 200]);
    }

    public function destroy($id)
    {
        $car = $this->carRepository->findOne($id);

        if (isset($car->image)) {
            Storage::delete($car->image);
        }

        $this->carRepository->delete($id);
        return  response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
