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
        $products = \App\Product::all();
        foreach ($products as $product){
                /** @var App\Product $product */
            $media = factory(Media::class)->make(['url' => '/img/products/1.jpg']);
            $product->media()->save($media);
            $media = factory(Media::class)->make(['url' => '/img/products/2.jpg']);
            $product->media()->save($media);
            $media = factory(Media::class)->make(['url' => '/img/products/3.jpg']);
            $product->media()->save($media);
            $media = factory(Media::class)->make(['url' => '/img/products/4.jpg']);
            $product->media()->save($media);
        }
//        factory(Media::class, 100)->create();
    }
}
