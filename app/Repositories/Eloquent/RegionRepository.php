<?php

namespace App\Repositories\Eloquent;

use App\Models\Region;
use App\Repositories\RegionRepositoryInterface;


class RegionRepository extends BaseRepository implements RegionRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Region();
    }



}
