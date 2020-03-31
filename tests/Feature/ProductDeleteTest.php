<?php

namespace Tests\Feature;

use App\Attribute;
use App\Category;
use App\Filter;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductDeleteTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    protected $user, $correctData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(Filter::class,2)->create(); // 1 group filter
        factory(Attribute::class,5)->create(['group_attribute_id' => 1]);
        factory(Product::class, 5)->create();

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_product()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('admin.product.destroy', ['product' => 2]));

//        dd($response);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertNull(Product::find(2));
        $this->assertTrue(Product::withTrashed()->find(2)->id == 2);
        $this->assertTrue(Product::all()->count() == 4);
    }
}
