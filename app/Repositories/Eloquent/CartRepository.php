<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\CartRepositoryInterface;


class CartRepository extends BaseRepository implements CartRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Cart();
    }



}
