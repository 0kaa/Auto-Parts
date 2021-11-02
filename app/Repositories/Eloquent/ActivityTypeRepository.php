<?php

namespace App\Repositories\Eloquent;



use App\Models\ActivityType;
use App\Repositories\ActivityTypeRepositoryInterface;

class ActivityTypeRepository extends BaseRepository implements ActivityTypeRepositoryInterface
{

    public function __construct()
    {
        $this->model = new ActivityType();
    }



}
