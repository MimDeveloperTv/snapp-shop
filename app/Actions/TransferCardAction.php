<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class CreateOrderAction
{
    use AsAction;

    /**
     * Execute the action.
     *
     * @throws Throwable
     */
    public function handle($request): array
    {
        try {

            $products = Product::query()->whereIn('id', $ids)->get();
            $total = $products->sum('price');

           $order =  Order::query()->create([
                'user_id' => auth()->id(),
                'price' => $total,
                'notifyAdmin' => false,
            ]);

            foreach ($products as $product) {
                OrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id ,
                    'price' => $product->price,
                ]);
            }

            return [
                'total' => $total,
                'order' => $order->id,
            ];

        } catch (\Exception $exception) {

            throw new \Exception('Creating Order Operation Has Error', 500);
        }
    }
}
