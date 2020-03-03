<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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
            factory(Payment::class)->make(['order_id' => $order->id])->save();
        }
    }
}
