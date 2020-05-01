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
        $shippings = [];
        foreach ($orders as $order){
//            factory(Shipping::class)->make(['order_id' => $order->id])->save();
            $shippings[] = factory(Shipping::class)->make(['order_id' => $order->id])->getAttributes();
        }
//        $shippings[] = factory(Shipping::class)->make(['order_id' => $order->id])->save();
        Shipping::insert($shippings);
//        factory(Shipping::class, 100)->create();
    }
}
