<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Repositories\CartItemRepositoryInterface;


class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface
{

    public function __construct()
    {
        $this->model = new CartItem();
    }
}
