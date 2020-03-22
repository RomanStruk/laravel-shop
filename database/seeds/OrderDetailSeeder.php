<?php

use App\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
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
            factory(OrderDetail::class)->make(['order_id' => $order->id])->save();
        }
    }
}
