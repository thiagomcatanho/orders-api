<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Support\BaseService;

class ClientService extends BaseService
{
    public function __construct(ClientRepository $repository)
    {
        parent::__construct($repository);
    }
}