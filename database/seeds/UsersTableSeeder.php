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
            ]
        ]);
        DB::table('user_details')->insert([
            [
                'user_id' => 1,
                'first_name' => 'Roman',
                'last_name' => 'Struk',
                'phone' => '+12345678901',
                'avatar' => '/storage/avatars/avatar-2.jpg',
                'country' => 'Ukraine',
                'birthday' => '1993-05-28',
                'location' => 'Some address',
            ]
        ]);
        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
            ]
        ]);
        factory(App\User::class, 50)->create()->each(function($user) {
            /** @var App\User $user */
            $detail = factory(App\UserDetail::class)->make(['user_id' => $user->id]);
            $user->detail()->save($detail);
            $user->roles()->sync([3]);

            $order = factory(App\Order::class,5)->make(['user_id' => $user->id]);
            $user->orders()->insert($order->toArray());
        });
    }
}
