<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
            ], [
                'name' => 'roman',
                'email' => 'roman@gmail.com',
                'password' => Hash::make('12345'),
            ]
        ]);
        factory(App\User::class, 50)->create()->each(function($user) {
            /** @var App\User $user */
            $detail = factory(App\UserDetail::class)->make(['user_id' => $user->id]);
            $user->detail()->save($detail);

            $order = factory(App\Order::class,3)->make(['user_id' => $user->id]);
            $user->orders()->insert($order->toArray());
        });
    }
}
