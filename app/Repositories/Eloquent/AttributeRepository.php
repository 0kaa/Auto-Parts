<?php

namespace App\Repositories\Eloquent;



use App\Models\Attribute;
use App\Repositories\AttributeRepositoryInterface;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Attribute();
    }
}
