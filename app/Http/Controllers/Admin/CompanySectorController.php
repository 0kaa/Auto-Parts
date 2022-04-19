<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanySectorRequest;
use App\Repositories\CompanySectorRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;

class CompanySectorController extends Controller
{
    protected $companySectorRepository;
    protected $filesServices;

    private $companyDirectory = 'companies';

    public function __construct(CompanySectorRepositoryInterface $companySectorRepository, UploadFilesServices $filesServices)
    {
        $this->companySectorRepository = $companySectorRepository;
        $this->filesServices = $filesServices;
    }

    public function index()
    {
        $company_sectors = $this->companySectorRepository->getAll();
        return view('admin.company-sectors.index', compact('company_sectors'));
    }


    public function create()
    {
        return view('admin.company-sectors.create');
    }


    public function store(CompanySectorRequest $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->companyDirectory);
        }

        $this->companySectorRepository->create(array_merge($request->except('image'), ['image' => $image]));
        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.company-sectors')]), 200]);
    }

    public function edit($id)
    {
        $company_sector = $this->companySectorRepository->findOne($id);
        return view('admin.company-sectors.create', compact('company_sector'));
    }

    public function update($id, CompanySectorRequest $request)
    {
        $this->companySectorRepository->update($request->except('_method'), $id);
        $companySector = $this->companySectorRepository->findOne($id);

        $image = $companySector->image;

        if ($request->hasFile('image')) {
            Storage::delete($companySector->image);
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->companyDirectory);
        }

        $this->companySectorRepository->update(array_merge($request->except('_method', 'image'), ['image' => $image]), $id);

        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.company-sectors')]), 200]);
    }

    public function destroy($id)
    {
        $companySector = $this->companySectorRepository->findOne($id);

        if (isset($companySector->image)) {
            Storage::delete($companySector->image);
        }

        $this->companySectorRepository->delete($id);

        return  response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
