<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaticPageRequest;
use App\Repositories\StaticPageRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaticPageController extends Controller
{
    //

    protected $staticPageRepository;
    protected $filesServices;

    private $staticPageDirectory='static-page';

    public function __construct(StaticPageRepositoryInterface $staticPageRepository,
                                UploadFilesServices $filesServices)
    {
        $this->staticPageRepository=$staticPageRepository;
        $this->filesServices=$filesServices;
    }

    public function index(){
    $static_pages=$this->staticPageRepository->getAll();
     return view('admin.static-pages.index',compact('static_pages'));
    }

    public function edit($slug){
        $static_page=$this->staticPageRepository->findWhere([['slug',$slug]]);
        return view('admin.static-pages.edit',compact('static_page'));
    }

    public function update($slug,StaticPageRequest $request){
        $static_page=$this->staticPageRepository->findWhere([['slug',$slug]]);

        $main_image=$static_page->main_image;

        if($request->hasFile('main_image')) {
            Storage::delete($static_page->main_image);

            $img=$request->file('main_image');
            $main_image = $this->filesServices->uploadfile($img, $this->staticPageDirectory);
        }

        $sub_image=$static_page->sub_image;

        if($request->hasFile('sub_image')) {
            Storage::delete($static_page->sub_image);

            $sub_img=$request->file('sub_image');
            $sub_image = $this->filesServices->uploadfile($sub_img, $this->staticPageDirectory);
        }


        if($request->hasFile('main_image_home')) {
            Storage::delete($static_page->main_image_home);

            $img_home=$request->file('main_image_home');
            $main_image_home = $this->filesServices->uploadfile($img_home, $this->staticPageDirectory);
        }

        $sub_image_home=$static_page->sub_image_home;

        if($request->hasFile('sub_image_home')) {
            Storage::delete($static_page->sub_image_home);

            $sub_img_home=$request->file('sub_image_home');
            $sub_image_home = $this->filesServices->uploadfile($sub_img_home, $this->staticPageDirectory);
        }

        $this->staticPageRepository->updateWhere(array_merge(['main_image'=>$main_image,'sub_image'=>$sub_image,'sub_image_home'=>$sub_image_home,'main_image_home'=>$main_image_home],$request->except('main_image','sub_image','_method','main_image_home','sub_image_home')),[['slug',$slug]]);

        return  response()->json(['success' => trans('admin.updated_success' , ['field' => __('local.static-pages')]) , 200]);

    }
}
