<?php

use App\OrderHistory;
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
        $array = [];
        foreach ($orders as $order){
            $array[] = factory(OrderHistory::class)->make(['order_id' => $order->id, 'status' => $order->status])->getAttributes();
        }
        OrderHistory::insert($array);
    }
}
