<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\OrderItemRepositoryInterface;


class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{

    public function __construct()
    {
        $this->model = new OrderItem();
    }
}
