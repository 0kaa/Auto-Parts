<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\SendContactUsRequest;
use App\Models\CustomOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function lang($locale)
    {

        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }

        \session()->put('locale', $locale);

        return redirect()->back();
    }


    public function index()
    {

        $users = User::count();

        $orders = Order::count();

        $custom_orders = CustomOrder::count();

        return view('admin.dashboard', compact('users' , 'orders' , 'custom_orders'));
    }
}
