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
        $array = [];
        foreach ($orders as $order){
            $array[] = factory(Payment::class)->make(['order_id' => $order->id])->getAttributes();
        }
        Payment::insert($array);
    }
}
