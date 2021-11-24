<?php

namespace App\Repositories\Eloquent;



use App\Models\SubActivity;
use App\Repositories\SubActivityTypeRepositoryInterface;

class SubActivityTypeRepository extends BaseRepository implements SubActivityTypeRepositoryInterface
{

    public function __construct()
    {
        $this->model = new SubActivity();
    }



}
