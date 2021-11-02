<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Product();
    }



}
