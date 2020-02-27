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
        factory(Shipping::class, 100)->create()->each(function($c) {
            /** @var Shipping $c */
            $c->order()->save(
                factory(App\Order::class)->make()
            );
        });
    }
}
