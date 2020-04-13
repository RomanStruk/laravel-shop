<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Analytics extends TestCase
{
    public function test_db_data()
    {
        $this->assertTrue(Product::all()->count()>0);
    }

    public function test_class_analytics()
    {
        $analytics = new \App\Services\Analytics\Analytics();
        $products = $analytics->getSoldProduct(1, '', '');
        dd($products);
        $this->assertTrue($products->count()>0, 'test count products');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
