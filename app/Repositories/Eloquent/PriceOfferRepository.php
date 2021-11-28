<?php

namespace App\Repositories\Eloquent;

use App\Models\PriceOffer;
use App\Repositories\PriceOfferRepositoryInterface;


class PriceOfferRepository extends BaseRepository implements PriceOfferRepositoryInterface
{

    public function __construct()
    {
        $this->model = new PriceOffer();
    }



}
