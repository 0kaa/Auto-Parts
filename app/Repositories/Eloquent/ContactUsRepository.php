<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;
use App\Repositories\ContactUsRepositoryInterface;


class ContactUsRepository extends BaseRepository implements ContactUsRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Contact();
    }



}
