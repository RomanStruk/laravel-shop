<?php

use App\OrderHistory;
use App\Shipping;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        foreach ($users as $user){
            $order = factory(App\Order::class,5)->make(['user_id' => $user->id]);
            $user->orders()->insert($order->toArray());
        }

        $orders = \App\Order::allRelations()->get();
        $products = \App\Product::with('syllable')->get();
        foreach ($orders as $order){
            $orderProduct = [];
            $randomProducts = $products->random(rand(2,8));
            foreach ($randomProducts as $product){
                $orderProduct[] = [
                    'product_id' => $product->id,
                    'syllable_id' => $product->syllable->first()->id,
                    'sale_price' => $product->price,
                    'count' => rand(1, 5),
                ];
            }
            $order->orderProducts()->createMany($orderProduct);

            //create payment information
            $payments[] = factory(\App\Payment::class)->make(['order_id' => $order->id])->getAttributes();
//            $order->paymentCreate(factory(\App\Payment::class)->make()->getAttributes());

            // create shipping information
            $Shipping[] = factory(Shipping::class)->make(['order_id' => $order->id])->getAttributes();

            //історія замовлень
            $OrderHistory[] = factory(OrderHistory::class)->make(
                ['order_id' => $order->id, 'status' => \App\Order::STATUS_PENDING]
            )->getAttributes();
            if ($order->status != \App\Order::STATUS_PENDING){
                $OrderHistory[] = factory(OrderHistory::class)->make(
                    ['order_id' => $order->id, 'status' => $order->status, 'comment' => 'Зміна статусу']
                )->getAttributes();
            }






            //

        }
        \App\Payment::insert($payments);
        \App\Shipping::insert($Shipping);
        OrderHistory::insert($OrderHistory);

        $orders->load('orderProducts');
        foreach ($orders as $order) {
            //списання товарів
            if ($order->status == \App\Order::STATUS_COMPLETED) {
                foreach ($order->orderProducts as $orderProduct) {
                    $orderProduct->syllable->remains = $orderProduct->syllable->remains - $orderProduct->count;
                    $orderProduct->syllable->save();

                }
            }
        }
    }
}
