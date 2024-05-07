<?php

namespace App\Support;

use Illuminate\Support\Traits\ForwardsCalls;

abstract class BaseService
{
    use ForwardsCalls;

    public function __construct(protected BaseRepository $repository)
    {
    }

    public function __call($method, $arguments)
    {
        return $this->forwardCallTo($this->repository, $method, $arguments);
    }
}
