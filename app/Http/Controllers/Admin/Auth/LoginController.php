<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $usersRepository;

    public function __construct(UserRepositoryInterface $usersRepository){

        $this->usersRepository = $usersRepository;
    }

    public function showLoginForm()
    {
        if(!auth()->check())
        {
            return view('admin.auth.login');

        }else{

            return redirect()->route('admin.dashboard');
        }

    }

    public function login(LoginRequest $request){

        $user = $this->usersRepository->getWhere([['email', $request->email]])->first();

        if($user && Hash::check($request->password, $user->password)){

            if($request->has('remember_me')){

                Auth::login($user, true);
            }
            else{

                Auth::login($user);
            }

            session()->flash('success', trans('local.login_success'));

            return redirect(route('admin.dashboard'));
        }

        session()->flash('error', trans('local.login_error'));

        return redirect()->back();

    }

    public function logout(){

        Auth::logout();
        return redirect()->route('show-login');

    }
}
