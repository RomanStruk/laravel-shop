<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productIds = Product::pluck('id')->toArray();
        $orderIds = Order::pluck('id')->toArray();

        $taggables = [];
        for ($i = 0; $i < (count($orderIds)*4); $i++) {
            $taggable['product_id'] = $productIds[array_rand($productIds)];
            $taggable['order_id'] = $orderIds[array_rand($orderIds)];
            $taggables[] = $taggable;
        }

        DB::table('order_product')->insert($taggables);
    }
}
