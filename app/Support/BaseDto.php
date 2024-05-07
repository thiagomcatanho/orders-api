<?php

namespace App\Support;

use Spatie\LaravelData\Data;

abstract class BaseDto extends Data
{
    public function onlyFilled(): array
    {
        return array_filter($this->toArray(), fn ($value) => ! is_null($value));
    }
}