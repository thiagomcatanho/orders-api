<?php

namespace App\Http\Controllers;

use App\Data\OrderSearchData;
use App\Enums\OrderStatus;
use App\Http\Requests\OrderChangeStatusRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderShowResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(OrderSearchData $data)
    {
        return OrderCollection::make($this->orderService->listOrders($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $order = DB::transaction(fn () => $this->orderService->createOrder($request->data()));

        return response()->json($order, JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(new OrderShowResource($this->orderService->find($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        $order = DB::transaction(fn () => $this->orderService->updateOrder($request->data(), $order));

        return response()->json($order);
    }

    public function changeStatus(OrderChangeStatusRequest $request, Order $order): JsonResponse
    {
        $this->orderService->changeStatus($order, OrderStatus::from($request->status));

        return response()->json(status: JsonResponse::HTTP_NO_CONTENT);
    }
}
