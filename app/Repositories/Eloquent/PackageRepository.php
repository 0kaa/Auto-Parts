<?php

namespace App\Repositories\Eloquent;

use App\Models\Package;
use App\Repositories\PackageRepositoryInterface;


class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Package();
    }



}
