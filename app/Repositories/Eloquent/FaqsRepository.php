<?php

namespace App\Repositories\Eloquent;

use App\Models\Faqs;
use App\Repositories\FaqsRepositoryInterface;


class FaqsRepository extends BaseRepository implements FaqsRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Faqs();
    }



}
