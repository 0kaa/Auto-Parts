<?php

namespace App\Repositories\Eloquent;

use App\Models\Shipping;
use App\Repositories\ShippingRepositoryInterface;


class ShippingRepository extends BaseRepository implements ShippingRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Shipping();
    }



}
