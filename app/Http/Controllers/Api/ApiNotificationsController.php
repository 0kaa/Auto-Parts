<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\NotificationResource;
use App\Repositories\NotificationRepositoryInterface;
use Carbon\Carbon;
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
    public function index()
    {
        $user = auth()->user();

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $notifications = $user->notifications;

        if (!$notifications) {
            return $this->ApiResponse(null, 'No notifications found', 404);
        }

        $todayNotifications = $notifications->where('created_at', '>=', $today)->where('created_at', '<=', $today->addDay());
        $yesterdayNotifications = $notifications->where('created_at', '>=', $yesterday)->where('created_at', '<=', $yesterday->addDay());
        // older than yesterday and not in yesterday
        $olderNotifications = $notifications->where('created_at', '<', $yesterday)->filter(function ($notification) {
            return $notification->created_at->diffInDays() > 1;
        });

        $notifications = [
            'today' => NotificationResource::collection($todayNotifications),
            'yesterday' => NotificationResource::collection($yesterdayNotifications),
            'older' => NotificationResource::collection($olderNotifications),
        ];


        // $notifications = $this->notificationRepository->getWhere(['user_id' => auth()->user()->id]);

        return $this->ApiResponse($notifications, null, 200);
    }
}
