<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PackageRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    //
    protected $packageRepository;
    protected $filesServices;

    private $badgeDirectory = 'badges';

    public function __construct(PackageRepositoryInterface $packageRepository, UploadFilesServices $filesServices)
    {
        $this->packageRepository = $packageRepository;
        $this->filesServices = $filesServices;
    }

    public function index()
    {
        $packages = $this->packageRepository->getAll();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $badge = '';
        if ($request->hasFile('badge')) {
            $img = $request->file('badge');
            $badge = $this->filesServices->uploadfile($img, $this->badgeDirectory);
        }
        $features = [];

        if ($request->featuresarray) {
            foreach (explode(',', $request->featuresarray) as $key => $feature) {
                $features[$key]['text'] = $feature;
            }
        }

        $this->packageRepository->create(array_merge($request->except('badge', 'featuresarray'), ['badge' => $badge, "features" => $features]));

        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.package')]), 200]);
    }

    public function edit($id)
    {
        $packages = $this->packageRepository->findOne($id);
        return view('admin.packages.edit', compact('packages'));
    }

    public function update($id, Request $request)
    {
        $package = $this->packageRepository->findOne($id);


        $badge = $package->badge;

        if ($request->hasFile('badge')) {
            Storage::delete($package->badge);
            $img = $request->file('badge');
            $badge = $this->filesServices->uploadfile($img, $this->badgeDirectory);
        }

        $features = [];
        if ($request->featuresarray) {
            foreach (explode(',', $request->featuresarray) as $key => $feature) {
                $features[$key]['text'] = $feature;
            }
        }

        $this->packageRepository->update(array_merge($request->except('_method', 'badge', 'featuresarray'), ['badge' => $badge, "features" => $features]), $id);

        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.package')]), 200]);
    }

    public function destroy($id)
    {
        $package = $this->packageRepository->findOne($id);

        if (isset($package->badge)) {
            Storage::delete($package->badge);
        }

        $this->packageRepository->delete($id);
        return  response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
