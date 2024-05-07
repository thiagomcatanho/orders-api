<?php

namespace App\Services;

use App\Data\OrderData;
use App\Models\Order;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Support\BaseService;

class OrderService extends BaseService
{
    public function __construct(
        OrderRepository $repository,
        private OrderProductRepository $orderProductRepository
    ) {
        parent::__construct($repository);
    }

    public function createOrder(OrderData $data): Order
    {
        $order = $this->repository->create($data->except('products'));

        $this->orderProductRepository->createOrderProducts($data->products, $order);

        return $order;
    }

    public function updateOrder(OrderData $data, Order $order): Order
    {
        $order = $this->repository->update($order, $data->except('products'));

        $this->orderProductRepository->updateOrderProducts($data->products, $order);

        return $order;
    }
}
