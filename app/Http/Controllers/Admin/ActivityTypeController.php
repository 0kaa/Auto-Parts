<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActivityTypeRequest;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityTypeController extends Controller
{
    //

    protected $activityTypeRepository;
    protected $filesServices;

    private $activityTypeDirectory='activity_type';

    public function __construct(ActivityTypeRepositoryInterface $activityTypeRepository,
                                UploadFilesServices $filesServices)
    {
        $this->activityTypeRepository=$activityTypeRepository;
        $this->filesServices=$filesServices;
    }

    public function index(){
        $activities_types=$this->activityTypeRepository->getAll();
        return view('admin.activity-type.index',compact('activities_types'));
    }


    public function create(){
        return view('admin.activity-type.create');
    }


    public function store(ActivityTypeRequest $request){
        $image='';
        if($request->hasFile('image')) {
            $img=$request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->activityTypeDirectory);
        }

        $this->activityTypeRepository->create(array_merge($request->except('image'),['image'=>$image]));
        return  response()->json(['success' => trans('admin.added_success' , ['field' => __('local.activities-types')]) , 200]);
    }

    public function edit($id){
        $activity_type=$this->activityTypeRepository->findOne($id);
        return view('admin.activity-type.create',compact('activity_type'));
    }

    public function update($id,ActivityTypeRequest $request){
        $activity_type=$this->activityTypeRepository->findOne($id);

        $image=$activity_type->image;

        if($request->hasFile('image')) {
            Storage::delete($activity_type->image);

            $img=$request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->activityTypeDirectory);
        }

        $this->activityTypeRepository->update(array_merge($request->except('_method','image'),['image'=>$image]),$id);
        return  response()->json(['success' => trans('admin.updated_success' , ['field' => __('local.activities-types')]) , 200]);
    }

    public function destroy($id){
        $activity_type=$this->activityTypeRepository->findOne($id);

        if(isset($activity_type->image)) {
            Storage::delete($activity_type->image);
        }

        $this->activityTypeRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
