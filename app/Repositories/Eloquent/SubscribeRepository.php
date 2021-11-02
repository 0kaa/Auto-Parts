<?php

namespace App\Repositories\Eloquent;

use App\Models\Subscribe;
use App\Repositories\SubscribeRepositoryInterface;


class SubscribeRepository extends BaseRepository implements SubscribeRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Subscribe();
    }



}
