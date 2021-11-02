<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SettingRepositoryInterface;

class SettingController extends Controller
{

    protected $settingrepository;

    public function __construct(SettingRepositoryInterface $settingrepository)
    {
        $this->settingrepository=$settingrepository;
    }

    public function index()
    {

        $settings = $this->settingrepository->getAll();

        return view('admin.settings.edit' , compact('settings'));

    } // end of index

    public function store(Request $request)
    {

        $attrbiute = $request->except('_token' , 'image_pro_index');

        // uploade one image_pro_index
        if($request->has('image_pro_index'))
        {

            // Upload new image_pro_index
            $attrbiute['image_pro_index'] = $request->file('image_pro_index')->store('setting');
        
        } // end of has image  


        $settings = $this->settingrepository->updateSetting($attrbiute);

        return redirect()->back()->with('success' , trans('local.success_setting'));

    } // end of store

}
