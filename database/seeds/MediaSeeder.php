<?php

use App\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media[] = (factory(Media::class)->create(['url' => '/img/products/1.jpg']))->id;
        $media[] = (factory(Media::class)->create(['url' => '/img/products/2.jpg']))->id;
        $media[] = (factory(Media::class)->create(['url' => '/img/products/3.jpg']))->id;
        $media[] = (factory(Media::class)->create())->id;
//        dd($media);
        $products = \App\Product::all();
        foreach ($products as $product){
            /** @var App\Product $product */
            $product->media()->attach($media);
//            $product->media()->attach($media);
//            $product->media()->attach($media);
//            $product->media()->attach($media);
        }
//        factory(Media::class, 100)->create();
    }
}
