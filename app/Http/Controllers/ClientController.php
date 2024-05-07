<?php

namespace App\Http\Controllers;

use App\Data\ClientSearchData;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(private ClientService $clientService)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ClientSearchData $data): JsonResponse
    {
        return response()->json($this->clientService->listClients($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request): JsonResponse
    {
        return response()->json($this->clientService->create($request->data(), JsonResponse::HTTP_CREATED));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json($this->clientService->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateRequest $request, Client $client): JsonResponse
    {
        return response()->json($this->clientService->update($client, $request->data()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->clientService->delete($id);

        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
