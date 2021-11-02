<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegionRequest;
use App\Repositories\RegionRepositoryInterface;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //

    protected $regionRepository;
    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository=$regionRepository;
    }

    public function index(){
        $regions=$this->regionRepository->getAll();
        return view('admin.regions.index',compact('regions'));
    }

    public function create(){
        return view('admin.regions.create');
    }

    public function store(RegionRequest $request){
        $this->regionRepository->create($request->all());
        return  response()->json(['success' => trans('admin.added_success' , ['field' => __('local.region')]) , 200]);
    }

    public function edit($id){
        $region=$this->regionRepository->findOne($id);
        return view('admin.regions.create',compact('region'));
    }

    public function update($id,RegionRequest $request){
        $this->regionRepository->update($request->except('_method'),$id);
        return  response()->json(['success' => trans('admin.updated_success' , ['field' => __('local.region')]) , 200]);
    }

    public function destroy($id){
        $this->regionRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
