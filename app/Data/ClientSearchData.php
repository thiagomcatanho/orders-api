<?php

namespace App\Data;

use App\Support\BaseDto;
use App\Traits\SearchDataFunction;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ClientSearchData extends BaseDto
{
    use SearchDataFunction;
    
    public function __construct(
        public readonly ?string $search,
        public readonly ?int $perPage,
        public readonly ?string $orderBy,
    ) {
    }
}
