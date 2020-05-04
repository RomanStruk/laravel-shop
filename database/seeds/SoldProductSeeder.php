<?php

use Illuminate\Database\Seeder;

class SoldProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Order::where('status', '=', \App\Order::STATUS_COMPLETED)->with('products')->get();
        foreach ($orders as $order){
            $insert = [];
            foreach ($order->products as $product){
                $insert[] = factory(\App\SoldProduct::class)->make([
                    'product_id' => $product->id,
                    'sale_price' => $product->price,
                    'created_at' => $order->created_at
                ])->getAttributes();
            }
            \App\SoldProduct::insert($insert);
        }
    }
}
