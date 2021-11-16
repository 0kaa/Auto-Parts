<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\NotificationResource;
use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Http\Request;

class ApiNotificationsController extends Controller
{
    use ApiResponseTrait;
    private $notificationRepository;
    public function __construct(
        NotificationRepositoryInterface $notificationRepository
    ) {
        $this->notificationRepository = $notificationRepository;
    }
    public function index(Request $request)
    {
        $notifications = $this->notificationRepository->getWhere(['user_id' => auth()->user()->id]);

        return $this->ApiResponse(NotificationResource::collection($notifications), null, 200);
    }
}
