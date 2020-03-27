<?php

namespace Tests\Feature;

use App\Attribute;
use App\Category;
use App\GroupAttribute;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Http\Response;

class ProductCreateTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    protected $user, $correctData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(GroupAttribute::class,2)->create(); // 1 group group_attribute
        factory(Attribute::class,5)->create(['group_attribute_id' => 1]);
        factory(Attribute::class,5)->create(['group_attribute_id' => 2]);
        $this->correctData = [
            'title' => $this->faker->sentence(),
            'alias' => $this->faker->slug(),
            'category_id' => 1,
            'keywords' => $this->faker->paragraph(1),
            'description'=> $this->faker->paragraph(1),
            'content' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(50, 500),
            'in_stock' => $this->faker->numberBetween(1, 50),
            'status' => 1,
            'attributes' => [1,2,3,4,5],
            'media' => [
                UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000),
                UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(1000),
            ]
        ];
    }

    /** @test */
    public function request_should_fail_auth()
    {
        $response = $this->postJson(route('admin.product.store'), []);
        $response->assertStatus(
            Response::HTTP_UNAUTHORIZED
        );
    }
    /** @test */
    public function request_should_success_auth_fail_data()
    {
//        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)->postJson(route('admin.product.store'), []);
        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
        $response->assertJsonValidationErrors(['title', 'alias', 'category_id', 'keywords', 'description', 'content', 'price', 'in_stock']);
    }

    /** @test */
    public function request_should_fail_when_no_title_is_provided()
    {
//        $this->withoutExceptionHandling();
        $data = $this->correctData;
        $data['title'] = '';
        $response = $this->actingAs($this->user)
            ->postJson(route('admin.product.store'), $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors('title');
        $response->assertJsonMissingValidationErrors(['alias', 'category_id', 'keywords', 'description', 'content', 'price', 'in_stock', 'status', 'attributes']);
    }

    /** @test */
    public function request_should_pass_ok_when_data_is_provided()
    {
        $this->withoutExceptionHandling();
        $data = $this->correctData;
        $response = $this->actingAs($this->user)
            ->post(route('admin.product.store'), $data);

        $product = Product::findOrFail(1);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect();
        $this->assertTrue($product->id == 1);
        $this->assertTrue(count($product->product_attributes) == count($data['attributes']));
        $this->assertTrue(count($product->media) == count($data['media']));
    }
}
