<?php

namespace App\Repositories\Eloquent;

use App\Models\Rating;
use App\Repositories\RatingRepositoryInterface;


class RatingRepository extends BaseRepository implements RatingRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Rating();
    }



}
