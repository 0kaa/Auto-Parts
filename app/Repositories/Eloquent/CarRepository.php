<?php

namespace App\Repositories\Eloquent;

use App\Models\Car;
use App\Repositories\CarRepositoryInterface;


class CarRepository extends BaseRepository implements CarRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Car();
    }
}
