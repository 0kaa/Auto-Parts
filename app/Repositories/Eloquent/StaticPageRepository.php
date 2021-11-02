<?php

namespace App\Repositories\Eloquent;

use App\Models\StaticPage;
use App\Repositories\StaticPageRepositoryInterface;


class StaticPageRepository extends BaseRepository implements StaticPageRepositoryInterface
{

    public function __construct()
    {
        $this->model = new StaticPage();
    }



}
