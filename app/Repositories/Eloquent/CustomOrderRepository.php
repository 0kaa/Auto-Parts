<?php

namespace App\Repositories\Eloquent;

use App\Models\CustomOrder;
use App\Repositories\CustomOrderRepositoryInterface;


class CustomOrderRepository extends BaseRepository implements CustomOrderRepositoryInterface
{

    public function __construct()
    {
        $this->model = new CustomOrder();
    }
}
