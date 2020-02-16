<?php

use Illuminate\Database\Seeder;

class GroupAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Фірма виробник', //1
            ],
            [
                'name' => 'Тип', //2
            ],
            [
                'name' => 'Механизм', //3
            ],
            [
                'name' => 'Материал', //4
            ],
            [
                'name' => 'Цвет', //5
            ],
            [
                'name' => 'Цена', //6
            ],
        ];
        DB::table('group_attributes')->insert($data);
    }
}
