<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Role::class)->make(['name' => 'Admin'])->save();
        factory(\App\Role::class)->make(['name' => 'Editor'])->save();
        factory(\App\Role::class)->make(['name' => 'User'])->save();

    }
}
