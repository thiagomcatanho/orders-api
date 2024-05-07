<?php

namespace App\Traits;

trait SearchDataFunction
{
    public function orderBy(): string
    {
        return $this->orderBy?: 'desc';
    }

    public function perPage(): int
    {
        return $this->perPage ?: 10;
    }
}
