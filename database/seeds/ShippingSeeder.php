<?php

use App\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = App\Order::all();
        foreach ($orders as $order){
            factory(Shipping::class)->make(['order_id' => $order->id])->save();
        }
//        factory(Shipping::class, 100)->create();
    }
}
