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

        $products = \App\Product::all();
        $data = [];
        foreach ($products as $key => $product){
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(1, 7)
            ];
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(8, 11)
            ];
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(12, 16)
            ];
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(17, 20)
            ];
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(21, 24)
            ];
            $data[] = [
                'product_id' => $product->id,
                'attribute_id' => rand(25, 27)
            ];
        }
        DB::table('attribute_product')->insert($data);
    }
}
