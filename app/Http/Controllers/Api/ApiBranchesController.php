<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateBranchesRequest;
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

    public function update(UpdateBranchesRequest $request)
    {

        $user = auth()->user();

        if ($request->other_branches == 1) {
            $user->other_branches = 'yes';
            if ($request->branches) {
                $user->branches()->delete();
                foreach ($request->branches as $branch) {
                    $user->branches()->create([
                        'address'   => $branch['address'],
                        'city_id'   => $branch['city_id'],
                        'region_id' => $branch['region_id'],
                        'phone'     => $branch['phone'],
                    ]);
                }
            }
            $user->save();
        } elseif ($request->other_branches == 0) {
            $user->other_branches = 'no';
            $user->branches()->delete();
            $user->save();
        } else {
            return $this->ApiResponse(null, trans('local.other_branches_required'), 422);
        }



        return $this->ApiResponse(new StoreBranchesResource($user), trans('admin.updated_success'), 200);
    }
}
