<?php

use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
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
                'id' => 1,
                'value' => 'Casio',
                'group_attribute_id' => 1
            ],
            [
                'id' => 2,
                'value' => 'Citizen',
                'group_attribute_id' => 1
            ],
            [
                'id' => 3,
                'value' => 'Daniel Klein',
                'group_attribute_id' => 1
            ],
            [
                'id' => 4,
                'value' => 'Orient',
                'group_attribute_id' => 1
            ],
            [
                'id' => 5,
                'value' => 'Q&Q',
                'group_attribute_id' => 1
            ],
            [
                'id' => 6,
                'value' => 'Seiko',
                'group_attribute_id' => 1
            ],
            [
                'id' => 7,
                'value' => 'Skmei',
                'group_attribute_id' => 1
            ],

            [
                'id' => 8,
                'value' => 'Для девочек',
                'group_attribute_id' => 2
            ],
            [
                'id' => 9,
                'value' => 'Для мальчиков',
                'group_attribute_id' => 2
            ],
            [
                'id' => 10,
                'value' => 'Женские',
                'group_attribute_id' => 2
            ],
            [
                'id' => 11,
                'value' => 'Мужские',
                'group_attribute_id' => 2
            ],


            [
                'id' => 12,
                'value' => 'Автокварцевый',
                'group_attribute_id' => 3
            ],
            [
                'id' => 13,
                'value' => 'Кварцевый',
                'group_attribute_id' => 3
            ],
            [
                'id' => 14,
                'value' => 'Механический',
                'group_attribute_id' => 3
            ],
            [
                'id' => 15,
                'value' => 'Механический с автоподзаводом',
                'group_attribute_id' => 3
            ],
            [
                'id' => 16,
                'value' => 'Электронный',
                'group_attribute_id' => 3
            ],


            [
                'id' => 17,
                'value' => 'Комбинированный материал',
                'group_attribute_id' => 4
            ],
            [
                'id' => 18,
                'value' => 'Металл',
                'group_attribute_id' => 4
            ],
            [
                'id' => 19,
                'value' => 'Пластик',
                'group_attribute_id' => 4
            ],
            [
                'id' => 20,
                'value' => 'Ювелирная сталь',
                'group_attribute_id' => 4
            ],

            [
                'id' => 21,
                'value' => 'Белый',
                'group_attribute_id' => 5
            ],
            [
                'id' => 22,
                'value' => 'Другие',
                'group_attribute_id' => 5
            ],
            [
                'id' => 23,
                'value' => 'Коричневый',
                'group_attribute_id' => 5
            ],
            [
                'id' => 24,
                'value' => 'Красный',
                'group_attribute_id' => 5
            ],

            [
                'id' => 25,
                'value' => '0 - 100',
                'group_attribute_id' => 6
            ],
            [
                'id' => 26,
                'value' => '100-1000',
                'group_attribute_id' => 6
            ],
            [
                'id' => 27,
                'value' => 'больше 1000',
                'group_attribute_id' => 6
            ]



        ];
        DB::table('attributes')->insert($data);
    }
}
