<?php

namespace App\Repositories\Eloquent;

use App\Models\Favourite;
use App\Repositories\FavouriteRepositoryInterface;


class FavouriteRepository extends BaseRepository implements FavouriteRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Favourite();
    }
}
