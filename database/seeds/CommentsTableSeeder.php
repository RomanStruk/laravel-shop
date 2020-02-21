<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('comments')->insert([
            [
                'product_id' => '1',
                'user_id' => '1',
                'rating' => 5,
                'text' => 'Коментар до першого продукту',
            ],
            [
                'product_id' => '1',
                'user_id' => '1',
                'rating' => 3,
                'text' => 'Другий коментар до першого продукту',
            ],
            [
                'product_id' => '2',
                'user_id' => '1',
                'rating' => 4,
                'text' => 'Перший коментар до другого продукту',
            ]
        ]);
    }
}
