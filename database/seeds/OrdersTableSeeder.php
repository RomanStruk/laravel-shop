<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'name' => '',
                'phone' => '',
                'city_code' => 1234,
                'email' => '',
                'type_delivery' => '',
                'pay_method' => ''
            ],[
                'id' => 2,
                'user_id' => 2,
                'name' => '',
                'phone' => '',
                'city_code' => 1235,
                'email' => '',
                'type_delivery' => '',
                'pay_method' => ''
            ]
        ]);
    }
}
