<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiAccountController extends Controller
{
    use ApiResponseTrait;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository  = $userRepository;
    }


    public function index()
    {
        $user = auth()->user();
        return $this->ApiResponse(new UserResource($user), null, 200);
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $user->update([
            'name' => ($request->get('name') ? $request->get('name') : $user->name),
            'email' => ($request->get('email') ? $request->get('email') : $user->email),
            'phone' => ($request->get('phone') ? $request->get('phone') : $user->phone),
            'address' => ($request->get('address') ? $request->get('address') : $user->address),
            'image' => ($request->has('image') ? $request->file('image') : $user->image),
        ]);

        return $this->ApiResponse(new UserResource($user), trans('admin.updated_success'), 200);
    }
}
