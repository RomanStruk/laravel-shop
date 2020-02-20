<?php

use Illuminate\Database\Seeder;

class AttributeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'attribute_id' => 1,
                'product_id' => 1
            ],
            [
                'attribute_id' => 3,
                'product_id' => 1
            ],
            [
                'attribute_id' => 13,
                'product_id' => 1
            ],
            [
                'attribute_id' => 17,
                'product_id' => 1
            ],

            [
                'attribute_id' => 2,
                'product_id' => 2
            ],
            [
                'attribute_id' => 4,
                'product_id' => 2
            ],
            [
                'attribute_id' => 12,
                'product_id' => 2
            ],
            [
                'attribute_id' => 17,
                'product_id' => 2
            ],

            [
                'attribute_id' => 2,
                'product_id' => 3
            ],
            [
                'attribute_id' => 4,
                'product_id' => 3
            ],
            [
                'attribute_id' => 12,
                'product_id' => 3
            ],
            [
                'attribute_id' => 17,
                'product_id' => 3
            ],

            [
                'attribute_id' => 2,
                'product_id' => 4
            ],
            [
                'attribute_id' => 4,
                'product_id' => 4
            ],
            [
                'attribute_id' => 12,
                'product_id' => 4
            ],
            [
                'attribute_id' => 17,
                'product_id' => 4
            ]
        ];
        DB::table('attribute_product')->insert($data);
    }
}
