<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Support\BaseRepository;

class OrderProductRepository extends BaseRepository
{
    public function modelClass(): string
    {
        return OrderProduct::class;
    }

    public function createOrderProducts(array $products, Order $order): void
    {
        /** 
         * @var \App\Data\OrderProductsData 
         */
        foreach ($products as $product) {
            $this->entity->create(array_merge($product->onlyFilled(), [
                'order_id' => $order->id
            ]));
        }
    }

    public function updateOrderProducts(array $products, Order $order): void
    {
        $this->entity->where(['order_id' => $order->id])->delete();
        $this->createOrderProducts($products, $order);
    }
}
