<?php

namespace App\Repositories\Eloquent;

use App\Models\DeviceToken;
use App\Repositories\DeviceTokenRepositoryInterface;


class DeviceTokenRepository extends BaseRepository implements DeviceTokenRepositoryInterface
{

    public function __construct()
    {
        $this->model = new DeviceToken();
    }



}
