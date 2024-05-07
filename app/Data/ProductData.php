<?php

namespace App\Data;

use App\Support\BaseDto;

class ProductData extends BaseDto
{
    public function __construct(
        public string $name,
        public float $price,
    ) {
    }
}
