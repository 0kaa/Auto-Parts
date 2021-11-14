<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;


class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Order();
    }



}
