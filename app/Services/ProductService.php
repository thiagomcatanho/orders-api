<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Support\BaseService;

class ProductService extends BaseService
{
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }
}