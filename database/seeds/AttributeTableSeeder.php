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
                'filter_id' => 1
            ],
            [
                'id' => 2,
                'value' => 'Citizen',
                'filter_id' => 1
            ],
            [
                'id' => 3,
                'value' => 'Daniel Klein',
                'filter_id' => 1
            ],
            [
                'id' => 4,
                'value' => 'Orient',
                'filter_id' => 1
            ],
            [
                'id' => 5,
                'value' => 'Q&Q',
                'filter_id' => 1
            ],
            [
                'id' => 6,
                'value' => 'Seiko',
                'filter_id' => 1
            ],
            [
                'id' => 7,
                'value' => 'Skmei',
                'filter_id' => 1
            ],

            [
                'id' => 8,
                'value' => 'Для девочек',
                'filter_id' => 2
            ],
            [
                'id' => 9,
                'value' => 'Для мальчиков',
                'filter_id' => 2
            ],
            [
                'id' => 10,
                'value' => 'Женские',
                'filter_id' => 2
            ],
            [
                'id' => 11,
                'value' => 'Мужские',
                'filter_id' => 2
            ],


            [
                'id' => 12,
                'value' => 'Автокварцевый',
                'filter_id' => 3
            ],
            [
                'id' => 13,
                'value' => 'Кварцевый',
                'filter_id' => 3
            ],
            [
                'id' => 14,
                'value' => 'Механический',
                'filter_id' => 3
            ],
            [
                'id' => 15,
                'value' => 'Механический с автоподзаводом',
                'filter_id' => 3
            ],
            [
                'id' => 16,
                'value' => 'Электронный',
                'filter_id' => 3
            ],


            [
                'id' => 17,
                'value' => 'Комбинированный материал',
                'filter_id' => 4
            ],
            [
                'id' => 18,
                'value' => 'Металл',
                'filter_id' => 4
            ],
            [
                'id' => 19,
                'value' => 'Пластик',
                'filter_id' => 4
            ],
            [
                'id' => 20,
                'value' => 'Ювелирная сталь',
                'filter_id' => 4
            ],

            [
                'id' => 21,
                'value' => 'Белый',
                'filter_id' => 5
            ],
            [
                'id' => 22,
                'value' => 'Другие',
                'filter_id' => 5
            ],
            [
                'id' => 23,
                'value' => 'Коричневый',
                'filter_id' => 5
            ],
            [
                'id' => 24,
                'value' => 'Красный',
                'filter_id' => 5
            ],

            [
                'id' => 25,
                'value' => '0 - 100',
                'filter_id' => 6
            ],
            [
                'id' => 26,
                'value' => '100-1000',
                'filter_id' => 6
            ],
            [
                'id' => 27,
                'value' => 'больше 1000',
                'filter_id' => 6
            ]



        ];
        DB::table('attributes')->insert($data);
    }
}
