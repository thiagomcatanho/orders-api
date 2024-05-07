<?php

namespace App\Repositories;

use App\Data\ClientSearchData;
use App\Models\Client;
use App\Support\BaseRepository;
use Illuminate\Pagination\Paginator;

class ClientRepository extends BaseRepository
{
    public function modelClass(): string
    {
        return Client::class;
    }

    public function listClients(ClientSearchData $params): Paginator
    {
        $query = Client::query();

        $query->when($params->search, function ($query, $value) {
            return $query->where('name', 'like', "%$value%")
                ->orWhere('phone', 'like', "%$value%")
                ->orWhere('address', 'like', "%$value%")
                ->orWhere('address_no', 'like', "%$value%")
                ->orWhere('address_complement', 'like', "%$value%")
                ->orWhere('neighborhood', 'like', "%$value%");
        });

        return $query->orderBy('id', $params->orderBy())->simplePaginate($params->perPage());
    }
}
