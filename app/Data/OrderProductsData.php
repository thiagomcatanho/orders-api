<?php

namespace App\Data;

use App\Support\BaseDto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderProductsData extends BaseDto
{
    public function __construct(
        public readonly int $productId,
        public readonly int $quantity,
    ) {
    }
}
