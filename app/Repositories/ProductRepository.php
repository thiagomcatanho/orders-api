<?php

namespace App\Repositories;

use App\Data\ProductSearchData;
use App\Models\Product;
use App\Support\BaseRepository;
use Illuminate\Pagination\Paginator;

class ProductRepository extends BaseRepository
{
    public function modelClass(): string
    {
        return Product::class;
    }

    public function listProducts(ProductSearchData $params): Paginator
    {
        $query = Product::query();

        $query->when($params->name, fn ($query, $name) => $query->where('name', 'like', "%$name%"));

        return $query->orderBy('id', $params->orderBy())->simplePaginate($params->perPage());
    }
}
