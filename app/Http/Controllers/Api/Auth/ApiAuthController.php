<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Web\ActiveCodeRequest;
use Illuminate\Validation\Validator;
use App\Http\Requests\web\RegisterRequest;
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
        try {
            if ($request->username) {
                $user = $this->usersRepository->getWhere([['username', $request->username]])->first();

                if (!$user) {
                    $user = $this->usersRepository->getWhere([['email', $request->username]])->first();
                }
            }

            if ($user && $user->approved == 0 && Hash::check($request->password, $user->password) && $request->type && $user->hasRole($request->type)) {
                return $this->ApiResponse(['phone' => $user->phone, 'approved' => $user->approved, 'code' => $user->verification_code], null, 200);
            }

            if ($user && $user->approved == 1 && Hash::check($request->password, $user->password) && $request->type && $user->hasRole($request->type)) {
                $token = $user->createToken('tokens')->plainTextToken;
            } else {
                return $this->ApiResponse(null, trans('admin.login_error'), 404);
            }

            $user_device_id = $user->devices->where('device_id', $request->device_id)->where('platform_type', $request->platform_type)->where('firebase_token', $request->firebase_token)->first();

            if (!$user_device_id) {
                $user->devices()->create([
                    'device_id'         => $request->device_id,
                    'platform_type'     => $request->platform_type,
                    'firebase_token'    => $request->firebase_token,
                    'user_id'           => $user->id,
                ]);
            } else {
                $user_device_id->delete();
                $user->devices()->create([
                    'device_id'         => $request->device_id,
                    'platform_type'     => $request->platform_type,
                    'firebase_token'    => $request->firebase_token,
                    'user_id'           => $user->id,
                ]);
            }

            return $this->ApiResponse(['token' => $token, 'user' => new UserResource($user)], trans('admin.login_success'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, trans('admin.login_error'), 404);
        }
    }

    public function register(RegisterRequest $request)
    {

        $attribute = $request->except('password', 'confirm_password');

        $attribute['password'] = bcrypt($request->password);
        $attribute['verification_code'] = rand(1111, 9999);
        $attribute['approved'] = 0;
        $user = $this->usersRepository->create($attribute);

        if ($user) {

            if ($request->type == 'user' || $request->type == 'workshop') {
                $user->assignRole($request->type);
            } else {
                return $this->ApiResponse(null, trans('local.user_type_not_found'), 404);
            }

            $user->devices()->create([
                'device_id'         => $request->device_id,
                'platform_type'     => $request->platform_type,
                'firebase_token'    => $request->firebase_token,
                'user_id'           => $user->id,
            ]);

            $token = $user->createToken('tokens')->plainTextToken;

            if ($user->approved == 1) {
                return $this->ApiResponse(['token' => $token, 'user' => new UserResource($user)], null, 200);
            } else {
                send_activation_code($user->verification_code, $user->phone);
                return $this->ApiResponse(['phone' => $user->phone, 'approved' => $user->approved], null, 200);
            }
        } else {
            return $this->ApiResponse(null, trans('local.failedRegister'), 404);
        }
    }

    public function verifyCode(ActiveCodeRequest $request)
    {
        try {
            $user = $this->usersRepository->getWhere([['verification_code', $request->code], ['phone', $request->phone]])->first();

            if (!$user) {
                return $this->ApiResponse(null, trans('local.verify_code_error'), 404);
            }

            $user_device_id = $user->devices->where('device_id', $request->device_id)->where('platform_type', $request->platform_type)->first();

            if ($user) {

                if (!$user_device_id) {
                    $user->devices()->create([
                        'device_id'         => $request->device_id,
                        'platform_type'     => $request->platform_type,
                        'firebase_token'    => $request->firebase_token,
                        'user_id'           => $user->id,
                    ]);
                }

                if ($user->hasRole('user')) {
                    $user->update(['approved' => 1, 'verification_code' => null]);
                } else {
                    $user->update(['approved' => 0, 'verification_code' => null]);
                }

                $token = $user->createToken('tokens')->plainTextToken;

                return $this->ApiResponse(['token' => $token, 'user' => new UserResource($user)], trans('local.verify_code_success'), 200);
            } else {
                return $this->ApiResponse(null, trans('local.verify_code_error'), 404);
            }
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e, 404);
        }
    }

    public function get_user()
    {
        $user = auth()->user();
        return $this->ApiResponse(['user' => new UserResource($user)], '', 200);
    }

    public function resetPassword(Request $request)
    {
        $phone = $request->phone;

        $user = $this->usersRepository->findWhere([
            ['phone', $phone],
        ]);
        if ($user && $user->approved == 1) {
            $code = rand(1111, 9999);
            $user->update(['verification_code' => $code]);
            send_activation_code($code, $phone);
            return $this->ApiResponse($code, trans('admin.code_sent'), 200);
        }

        return $this->ApiResponse(null, trans('errors.user_not_found'), 404);
    }

    public function verifyCodeNewPassword(Request $request)
    {

        $user = $this->usersRepository->findWhere([['phone', $request->phone]]);

        if ($user) {
            if ($user->verification_code == $request->code) {
                $token = $user->createToken('tokens')->plainTextToken;
                return $this->ApiResponse(['token' => $token], null, 200);
            } else {
                return $this->ApiResponse(null, trans('local.verify_code_error'), 404);
            }
        }

        return $this->ApiResponse(null, trans('errors.user_not_found'), 404);
    }


    public function newPassword(Request $request)
    {
        try {

            $user = auth()->user();

            if ($request->password == $request->password_confirm) {

                $user->update(['password' => bcrypt($request->password), 'verification_code' => null]);

                return $this->ApiResponse(null, trans('admin.updated_success'), 200);
            } else {
                return $this->ApiResponse(null, trans('validation.password'), 404);
            }
        } catch (\Exception $e) {

            return $this->ApiResponse(null, $e, 404);
        }
    }
}
