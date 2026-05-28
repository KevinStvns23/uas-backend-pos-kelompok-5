<?php

namespace App\Services;

use App\Repositories\DiscountRepository;

class DiscountService
{
    protected $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    // TODO: implement bisnis logic diskon
}