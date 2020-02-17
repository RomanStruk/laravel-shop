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
    }
}
