<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanySectorRequest;
use App\Repositories\CompanyModelRepositoryInterface;
use App\Repositories\CompanySectorRepositoryInterface;

use Illuminate\Http\Request;

class CompanyModelController extends Controller
{
    protected $companyModelRepository;

    public function __construct(CompanySectorRepositoryInterface $companySectorRepository, CompanyModelRepositoryInterface $companyModelRepository)
    {
        $this->companyModelRepository = $companyModelRepository;
        $this->companySectorRepository = $companySectorRepository;
    }

    public function index()
    {
        $company_models = $this->companyModelRepository->getAll();
        return view('admin.company-models.index', compact('company_models'));
    }


    public function create()
    {
        $companies = $this->companySectorRepository->getAll();

        return view('admin.company-models.create', compact('companies'));
    }


    public function store(Request $request)
    {
        $this->companyModelRepository->create($request->all());
        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.company-models')]), 200]);
    }

    public function edit($id)
    {
        $company_model = $this->companyModelRepository->findOne($id);
        $companies = $this->companySectorRepository->getAll();

        return view('admin.company-models.create', compact('company_model', 'companies'));
    }

    public function update($id, Request $request)
    {
        $this->companyModelRepository->update($request->except('_method'), $id);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.company-models')]), 200]);
    }

    public function destroy($id)
    {
        $this->companyModelRepository->delete($id);

        return  response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
