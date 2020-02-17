<?php

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
        DB::table('order_product')->insert([
            [
                'order_id' => 1,
                'product_id' => 1
            ],[
                'order_id' => 1,
                'product_id' => 6
            ],[
                'order_id' => 2,
                'product_id' => 3
            ],[
                'order_id' => 2,
                'product_id' => 7
            ]
        ]);
    }
}
