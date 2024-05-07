<?php

namespace App\Data;

use App\Support\BaseDto;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ClientData extends BaseDto
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $address,
        public string $addressNo,
        public ?string $address_complement,
        public string $neighborhood,
    ) {
    }
}
