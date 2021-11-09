<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\CityRepositoryInterface;


class CityRepository extends BaseRepository implements CityRepositoryInterface
{

    public function __construct()
    {
        $this->model = new City();
    }
}
