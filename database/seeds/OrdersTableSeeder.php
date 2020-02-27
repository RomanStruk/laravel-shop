<?php

use App\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Order::class, 50)->create();
        factory(Order::class, 50)->create()->each(function($c) {
            /** @var Order $c */
            $c->shipping()->save(
                factory(App\Shipping::class)->make(['order_id' => NULL])
            );
        });
        // Создать 5 Foo's и Bar для кажлого
//        factory(\App\Order::class, 50)->create()->each(function($order) {
//            $bar = factory(App\Bar::class)->make();
//            $order->bars()->save($bar);
//            $bar->pivot->price = 12;
//            $bar->pivot->save();
//        });
    }
}
