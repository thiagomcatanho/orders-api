<?php

namespace App\Data;

use App\Enums\PaymentForm;
use App\Support\BaseDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderData extends BaseDto
{
    public function __construct(
        public readonly int $clientId,

        #[WithCast(EnumCast::class, PaymentForm::class)]
        public readonly PaymentForm $paymentForm,

        #[DataCollectionOf(OrderProductsData::class)]
        public readonly array $products,
    ) {
    }
}
