<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Repositories\NotificationRepositoryInterface;


class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Notification();
    }
}
