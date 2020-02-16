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
                'parent_id' => Null,
                'name' => 'Компьютеры и ноутбуки',
                'slug' => 'computers-notebooks'
            ],
            [
                'parent_id' => Null,
                'name' => 'Смартфоны, ТВ и электроника',
                'slug' => 'telefony-tv-i-ehlektronika'
            ],
            [
                'parent_id' => Null,
                'name' => 'Бытовая техника, интерьер',
                'slug' => 'bt'
            ],
            [
                'parent_id' => Null,
                'name' => 'Товары для дома',
                'slug' => 'tovary-dlya-doma'
            ],
            [
                'parent_id' => Null,
                'name' => 'Одежда, обувь и аксессуары',
                'slug' => 'shoes_clothes'
            ],
            [
                'parent_id' => Null,
                'name' => 'Инструменты и автотовары',
                'slug' => 'instrumenty-i-avtotovary'
            ]
        ];
        DB::table('categories')->insert($data);
    }
}
