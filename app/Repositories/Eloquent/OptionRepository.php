<?php

namespace App\Repositories\Eloquent;



use App\Models\Option;
use App\Repositories\OptionRepositoryInterface;

class OptionRepository extends BaseRepository implements OptionRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Option();
    }
}
