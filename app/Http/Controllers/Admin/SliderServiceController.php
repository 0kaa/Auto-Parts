<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderServiceRequest;
use App\Repositories\SliderServiceRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderServiceController extends Controller
{
    //

    protected $sliderServiceRepository;
    protected $filesServices;
    private $SliderServiceDirectory='slider_service';

    public function __construct(SliderServiceRepositoryInterface $sliderServiceRepository,
                                UploadFilesServices $filesServices)
    {
        $this->sliderServiceRepository=$sliderServiceRepository;
        $this->filesServices=$filesServices;
    }

    public function index(){
        $slider_services=$this->sliderServiceRepository->getAll();
        return view('admin.sliders-services.index',compact('slider_services'));
    }

    public function create(){
        return view('admin.sliders-services.create');
    }

    public function store(SliderServiceRequest $request){
        $image='';
        if($request->hasFile('image')) {
            $img=$request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->SliderServiceDirectory);
        }

        $this->sliderServiceRepository->create(['image'=>$image]);
        return  response()->json(['success' => trans('admin.added_success' , ['field' => __('local.our_services_gallery')]) , 200]);
    }

    public function edit($id){
        $slider_service=$this->sliderServiceRepository->findOne($id);
        return view('admin.sliders-services.create',compact('slider_service'));
    }

    public function update($id,SliderServiceRequest $request){
        $slider_service=$this->sliderServiceRepository->findOne($id);

        $image=$slider_service->image;

        if($request->hasFile('image')) {
            Storage::delete($slider_service->image);

            $img=$request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->SliderServiceDirectory);
        }

        $this->sliderServiceRepository->update(['image'=>$image],$id);
        return  response()->json(['success' => trans('admin.updated_success' , ['field' => __('local.our_services_gallery')]) , 200]);
    }

    public function destroy($id){
        $slider_service=$this->sliderServiceRepository->findOne($id);

        if(isset($slider_service->image)) {
            Storage::delete($slider_service->image);
        }

        $this->sliderServiceRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
