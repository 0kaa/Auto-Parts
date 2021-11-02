<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\SendContactUsRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function lang($locale){
        
        if (! in_array($locale, ['en', 'ar'])) {
            abort(400);
        }

        \session()->put('locale', $locale);

        return redirect()->back();

    }


    public function index(){

     return view('admin.dashboard');
    }


}
