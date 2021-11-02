<?php

namespace App\Repositories\Eloquent;

use App\Models\SliderService;
use App\Repositories\SliderServiceRepositoryInterface;


class SliderServiceRepository extends BaseRepository implements SliderServiceRepositoryInterface
{

    public function __construct()
    {
        $this->model = new SliderService();
    }



}
