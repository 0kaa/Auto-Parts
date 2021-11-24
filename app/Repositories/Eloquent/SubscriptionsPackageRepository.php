<?php

namespace App\Repositories\Eloquent;

use App\Models\SubscriptionsPackage;
use App\Repositories\SubscriptionsPackageRepositoryInterface;


class SubscriptionsPackageRepository extends BaseRepository implements SubscriptionsPackageRepositoryInterface
{

    public function __construct()
    {
        $this->model = new SubscriptionsPackage();
    }



}
