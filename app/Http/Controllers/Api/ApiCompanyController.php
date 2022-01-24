<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StoreCompanyResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiCompanyController extends Controller
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

        return $this->ApiResponse(new StoreCompanyResource($user), null, 200);
    }

    public function update(Request $request)
    {

        $user = auth()->user();
        $user->update([
            'activity_type_id' => ($request->get('activity_type_id') ? $request->get('activity_type_id') : $user->activity_type_id),
            'name_company' => ($request->get('name_company') ? $request->get('name_company') : $user->name_company),
            'image' => ($request->has('image') ? $request->file('image')->store('user') : $user->image),
            'name_company' => ($request->get('name_company') ? $request->get('name_company') : $user->name_company),
            'name_owner_company' => ($request->get('name_owner_company') ? $request->get('name_owner_company') : $user->name_owner_company),
            'national_identity' => ($request->get('national_identity') ? $request->get('national_identity') : $user->national_identity),
            'date' => ($request->get('date') ? $request->get('date') : $user->date),
            'city_id' => ($request->get('city_id') ? $request->get('city_id') : $user->city_id),
            'region_id' => ($request->get('region_id') ? $request->get('region_id') : $user->region_id),
            'commercial_register_id' => ($request->get('commercial_register_id') ? $request->get('commercial_register_id') : $user->commercial_register_id),
            'file' => ($request->has('file') ? $request->file('file')->store('company') : $user->file),
        ]);

        return $this->ApiResponse(new StoreCompanyResource($user), trans('admin.updated_success'), 200);
    }
}
