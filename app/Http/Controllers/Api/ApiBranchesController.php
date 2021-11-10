<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StoreBranchesResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApiBranchesController extends Controller
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

        return $this->ApiResponse(new StoreBranchesResource($user), null, 200);
    }

    public function update(Request $request)
    {

        $user = auth()->user();

        $user->update([
            'activity_type_id' => ($request->get('activity_type_id') ? $request->get('activity_type_id') : $user->activity_type_id),
        ]);

        if ($request->branches) {
            $user->branches()->delete();
            foreach (json_decode($request->branches) as $branch) {
                $user->branches()->create([
                    'address'   => $branch->address,
                    'city'      => $branch->city_id,
                    'region_id' => $branch->region_id,
                    'phone'     => $branch->phone,
                ]);
            }
        }


        // $user->update([
        //     'activity_type_id' => ($request->get('activity_type_id') ? $request->get('activity_type_id') : $user->activity_type_id),

        // ]);

        return $this->ApiResponse(new StoreBranchesResource($user), trans('admin.updated_success'), 200);
    }
}
