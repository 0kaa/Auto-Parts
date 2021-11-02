<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanySectorRequest;
use App\Repositories\CompanySectorRepositoryInterface;
use Illuminate\Http\Request;

class CompanySectorController extends Controller
{
    //

    protected $companySectorRepository;

    public function __construct(CompanySectorRepositoryInterface $companySectorRepository)
    {
        $this->companySectorRepository=$companySectorRepository;
    }

    public function index(){
        $company_sectors=$this->companySectorRepository->getAll();
        return view('admin.company-sectors.index',compact('company_sectors'));
    }


    public function create(){
        return view('admin.company-sectors.create');
    }


    public function store(CompanySectorRequest $request){
        $this->companySectorRepository->create($request->all());
        return  response()->json(['success' => trans('admin.added_success' , ['field' => __('local.company-sectors')]) , 200]);
    }

    public function edit($id){
        $company_sector=$this->companySectorRepository->findOne($id);
        return view('admin.company-sectors.create',compact('company_sector'));
    }

    public function update($id,CompanySectorRequest $request){
        $this->companySectorRepository->update($request->except('_method'),$id);
        return  response()->json(['success' => trans('admin.updated_success' , ['field' => __('local.company-sectors')]) , 200]);
    }

    public function destroy($id){
        $this->companySectorRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
