<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
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
                'parent_id' => 0,
                'name' => 'Компьютеры и ноутбуки',
                'slug' => 'computers-notebooks'
            ],
            [
                'parent_id' => 1,
                'name' => 'Смартфоны, ТВ и электроника',
                'slug' => 'telefony-tv-i-ehlektronika'
            ],
            [
                'parent_id' => 0,
                'name' => 'Бытовая техника, интерьер',
                'slug' => 'bt'
            ],
            [
                'parent_id' => 0,
                'name' => 'Товары для дома',
                'slug' => 'tovary-dlya-doma'
            ],
            [
                'parent_id' => 0,
                'name' => 'Одежда, обувь и аксессуары',
                'slug' => 'shoes_clothes'
            ],
            [
                'parent_id' => 0,
                'name' => 'Инструменты и автотовары',
                'slug' => 'instrumenty-i-avtotovary'
            ]
        ];
        DB::table('categories')->insert($data);
    }
}
