<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\SendContactUsRequest;
use App\Http\Requests\web\SubscribeRequest;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\ContactUsRepositoryInterface;
use App\Repositories\SliderServiceRepositoryInterface;
use App\Repositories\StaticPageRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\SubscribeRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $staticPageRepository;
    protected $subscribeRepository;
    protected $activityTypeRepository;
    protected $sliderServiceRepository;
    protected $contactrepository;
    protected $settingrepository;

    public function __construct(StaticPageRepositoryInterface $staticPageRepository,
                                SubscribeRepositoryInterface $subscribeRepository,
                                ActivityTypeRepositoryInterface $activityTypeRepository,
                                SliderServiceRepositoryInterface $sliderServiceRepository,
                                ContactUsRepositoryInterface $contactrepository,
                                SettingRepositoryInterface $settingrepository
                                )
    {
        $this->staticPageRepository    = $staticPageRepository;
        $this->subscribeRepository     = $subscribeRepository;
        $this->activityTypeRepository  = $activityTypeRepository;
        $this->sliderServiceRepository = $sliderServiceRepository;
        $this->contactrepository       = $contactrepository;
        $this->settingrepository       = $settingrepository;
    }

    public function index(){

        $about_us=$this->staticPageRepository->findWhere([['slug','about-us']]);
        return view('website.index',compact('about_us'));
    }

    public function staticPage($slug){
        if ($slug=='about-us'){
            $about_us=$this->staticPageRepository->findWhere([['slug',$slug]]);

            $activities_type=$this->activityTypeRepository->getAll();

            $slider_services=$this->sliderServiceRepository->getAll();

            return view('website.static-pages.about-us',compact('about_us','activities_type','slider_services'));
        }else{
            $static_page=$this->staticPageRepository->findWhere([['slug',$slug]]);

            return view('website.static-pages.statics',compact('static_page'));
            
        }

    }

    public function subscribe(SubscribeRequest $request)
    {

        $this->subscribeRepository->create($request->all());
        return  response()->json(['success' => trans('admin.added_success' , ['field' => __('local.news_letter')]) , 200]);
    
    }


    public function contactUs ()
    {

        $email   = $this->settingrepository->getWhere(['key' => 'email'])->first();
        $phone   = $this->settingrepository->getWhere(['key' => 'phone'])->first();
        $address = $this->settingrepository->getWhere(['key' => 'address'])->first();
        $lat     = $this->settingrepository->getWhere(['key' => 'lat'])->first();
        $lng     = $this->settingrepository->getWhere(['key' => 'lng'])->first();

        return view('website.contact-us' , compact(
            'email',
            'phone',
            'address',
            'lat',
            'lng'
        ));

    } // end of contact us

    public function sendContactUs(SendContactUsRequest $request)
    {

        $attribute = $request->except('token');

        $this->contactrepository->create($attribute);

        return  response()->json(['success' => trans('local.contact_success')]);

    } // end of send contact us
}
