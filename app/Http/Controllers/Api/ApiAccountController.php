<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\ToggleNotificationsRequest;
use App\Http\Resources\Api\CompanySectorResource;
use App\Http\Resources\Api\UserResource;
use App\Models\CompanySector;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;

class ApiAccountController extends Controller
{
    use ApiResponseTrait;
    protected $userRepository;
    protected $filesServices;

    private $userDirectory = 'users';

    public function __construct(UserRepositoryInterface $userRepository, UploadFilesServices $filesServices)
    {
        $this->userRepository  = $userRepository;
        $this->filesServices = $filesServices;
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
            'first_name' => $request->first_name ? $request->first_name : $user->first_name,
            'last_name' => $request->last_name ? $request->last_name : $user->last_name,
            'username' => $request->username ? $request->username : $user->username,
            'commercial_register_id' => $request->commercial_register_id ? $request->commercial_register_id : $user->commercial_register_id,
            'email' => $request->email ? $request->email : $user->email,
            'phone' => $request->phone ? $request->phone : $user->phone,
            'address' => $request->address ? $request->address : $user->address,
            'image' => $request->hasFile('image') ? $this->filesServices->uploadfile($request->file('image'), $this->userDirectory) : $user->image,
        ]);

        return $this->ApiResponse(new UserResource($user), trans('admin.updated_success'), 200);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        $user_password = $user->password;

        if (Hash::check($request->password, $user_password)) {
            $new_password = bcrypt($request->new_password);
            $user->password = $new_password;
            $user->save();
            return $this->ApiResponse('null', trans('admin.updated_success'), 200);
        } else {
            return $this->ApiResponse('null', trans('admin.password_required'), 404);
        }
    }

    public function companiesSector()
    {
        $compaines = CompanySector::all();

        return $this->ApiResponse(CompanySectorResource::collection($compaines), trans('admin.updated_success'), 200);
    }

    public function toggleNotifications(ToggleNotificationsRequest $request)
    {
        try {
            $user = auth()->user();

            $notification_status = $request->notification_status;

            $notification_status = $notification_status == 1 ? 1 : 0;

            $user->is_notify = $notification_status;

            $user->save();

            if ($notification_status == 1) {
                return $this->ApiResponse(null, trans('local.notifications_turned_on'), 200);
            }
            return $this->ApiResponse(null, trans('local.notifications_turned_off'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }
}
