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
        foreach ($orderIds as $id){
            for ($i = 0; $i < (rand(2,8)); $i++) {
                $taggables[] = ['order_id'=>$id, 'product_id'=>$productIds[array_rand($productIds)]];
            }
        }

        DB::table('order_product')->insert($taggables);
    }
}
