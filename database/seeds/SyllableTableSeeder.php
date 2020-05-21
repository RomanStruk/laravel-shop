<?php

use Illuminate\Database\Seeder;

class SyllableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Product::all();
        foreach ($products as $product){
            factory(\App\Syllable::class)->make(['product_id' => $product->id, 'supplier_id' => rand(1,5)])->save();
        }
    }
}
