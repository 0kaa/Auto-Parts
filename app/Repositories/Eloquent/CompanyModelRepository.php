<?php

namespace App\Repositories\Eloquent;

use App\Models\CompanyModel;
use App\Repositories\CompanyModelRepositoryInterface;


class CompanyModelRepository extends BaseRepository implements CompanyModelRepositoryInterface
{

    public function __construct()
    {
        $this->model = new CompanyModel();
    }
}
