<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PackageResource;
use App\Repositories\PackageRepositoryInterface;
use App\Repositories\SubscriptionsPackageRepositoryInterface;
use Illuminate\Http\Request;

class ApiPackagesController extends Controller
{
    use ApiResponseTrait;
    private $packageRepository;
    private $subscriptionsPackageRepository;

    public function __construct(PackageRepositoryInterface $packageRepository, SubscriptionsPackageRepositoryInterface $subscriptionsPackageRepository)
    {
        $this->packageRepository                = $packageRepository;
        $this->subscriptionsPackageRepository   = $subscriptionsPackageRepository;
    }

    public function index()
    {
        $packages = $this->packageRepository->getAll();
        return $this->ApiResponse(PackageResource::collection($packages), null, 200);
    }

    public function subscriptions()
    {
        $subscriptions = $this->subscriptionsPackageRepository->getAll();
        return $this->ApiResponse($subscriptions, null, 200);
    }

    public function createSubscription(Request $request)
    {
        $user = auth()->user();

        $package = $this->packageRepository->findOne($request->plan_id);

        $subscriptions = $this->subscriptionsPackageRepository->getWhere(['user_id' => $user->id])->first();

        if ($subscriptions->plan_id == $request->plan_id) {
            return $this->ApiResponse(null, trans('local.already_subscriped_to_this_plan'), 403);
        }

        if ($subscriptions) {
            $subscriptions->plan_id = $request->plan_id;
            $subscriptions->save();
            return $this->ApiResponse(null, trans('local.subscription_updated'), 200);
        }

        if ($package) {

            $end_date = date('Y-m-d', strtotime('+' . $package->duration_time . 'days'));

            $subscription = $this->subscriptionsPackageRepository->create(
                [
                    'user_id'           => $user->id,
                    'plan_id'           => $request->plan_id,
                    'start_date'        => date('Y-m-d'),
                    'end_date'          => $end_date,
                    'status'            => 'active',
                ]
            );

            $user->package_id = $request->plan_id;
            $user->save();
            return $this->ApiResponse($subscription, null, 200);

        } else {
            return $this->ApiResponse(null, trans('local.plan_not_found'), 403);
        }
    }
}
