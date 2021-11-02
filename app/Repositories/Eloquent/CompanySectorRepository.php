<?php

namespace App\Repositories\Eloquent;

use App\Models\CompanySector;
use App\Repositories\CompanySectorRepositoryInterface;


class CompanySectorRepository extends BaseRepository implements CompanySectorRepositoryInterface
{

    public function __construct()
    {
        $this->model = new CompanySector();
    }



}