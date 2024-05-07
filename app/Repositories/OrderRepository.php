<?php

namespace App\Repositories;


use App\Data\OrderData;
use App\Data\OrderSearchData;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Support\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public function modelClass(): string
    {
        return Order::class;
    }

    public function createOrder(OrderData $data): Order
    {
        $order = $this->entity->create([
            'payment_form' => $data->paymentForm,
            'client_id' => $data->clientId,
            'user_id' => auth()->id(),
        ]);

        return $order;
    }

    public function changeStatus(Order $order, OrderStatus $status): void
    {
        $order->status = $status;
        $order->save();
    }

    public function listOrders(OrderSearchData $params): Paginator
    {
        $query = Order::query();

        $fields = [
            'orders.id',
            'orders.payment_form',
            'orders.status',
            DB::raw('SUM(order_products.product_price) as amount'),
            DB::raw('DATE_FORMAT(orders.created_at, "%d/%m/%Y %H:%i:%s") as created_at'),
            'orders.created_at',
            'clients.name as client_name',
            'clients.phone as client_phone',
            'clients.address as client_address',
            'clients.address_no as client_address_no',
            'clients.address_complement as client_address_complement',
        ];

        $query->select($fields)
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', $params->orderBy())
            ->when($params->search, function ($query, $param) {
                $query->where('clients.name', 'like', "%$param%");
            });

        return $query->simplePaginate($params->perPage());
    }
}
