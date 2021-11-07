<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\Validator;
use App\Http\Requests\Api\RegisterRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\UserResource;

class ApiAuthController extends Controller
{
    use ApiResponseTrait;
    private $usersRepository;

    public function __construct(UserRepositoryInterface $usersRepository)
    {

        $this->usersRepository = $usersRepository;
    }


    public function login(LoginRequest $request)
    {

        $user = $this->usersRepository->getWhere([['email', $request->email]])->first();


        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('tokens')->plainTextToken;
        }

        return $this->ApiResponse(['token' => $token, 'user' => new UserResource($user)], 'test message', 200);
    }

    public function register(Request $request)
    {

        $user = $this->usersRepository->create($request->all());

        $token = $user->createToken('tokens')->plainTextToken;

        $user->assignRole('owner_store');

        return $this->ApiResponse(['token' => $token, 'user' => new UserResource($user)], 'test message', 200);
    }

    public function get_user()
    {
        $user = auth()->user();
        // return $this->ApiResponse(['user' => $user], 'test message', 200);
        return $this->ApiResponse(['user' => new UserResource($user)], 'test message', 200);
    }
}
