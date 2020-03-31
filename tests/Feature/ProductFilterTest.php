<?php

namespace Tests\Feature;

use App\Attribute;
use App\Category;
use App\Filter;
use App\Product;
use App\Services\PaginateSession;
use App\Services\ScopeFilters\ProductsFilter;
use App\Services\Data\Product\GetProductsByLimit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ProductFilterTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_filter_by_category_for_products_with_filter_class()
    {
        factory(Category::class,5)->create();
        factory(Product::class)->create(['category_id' => 2]);
        $filters = [
            'category' => 2
        ];
        $products = (
            new GetProductsByLimit(
                new ProductsFilter(),
                new PaginateSession(Request::capture())
            )
        )->handel($filters);
        $this->assertTrue($products->total() == 1);
    }



    public function test_filter_by_category_slug_for_products_with_filter_class()
    {
        factory(Category::class)->create(['slug' => 'for-test']);
        factory(Product::class)->create(['category_id' => 1]);
        $filters = [
            'category' => 'for-test'
        ];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        $this->assertTrue($products->total() == 1);
    }

    public function test_filter_by_title_for_products_with_filter_class()
    {
        factory(Category::class)->create();
        factory(Product::class,50)->create(['title' => 'title-for-tests']);
        $filters = [
            'title' => 'for-test'
        ];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        $this->assertTrue($products->total() == 50);
    }

    public function test_filter_by_status_for_products_with_filter_class()
    {
        factory(Category::class)->create();
        $d = factory(Product::class,5)->create(['status' => 1]);
        $filters = [
            'status' => '1'
        ];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        $this->assertTrue($products->total() == 5);
    }


    public function test_filter_by_attribute_for_products_with_filter_class()
    {
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productsDb = factory(Product::class,5)->create(); // 5 products
        factory(Filter::class)->create(); // 1 group filter
        factory(Attribute::class)->create(['id' => 1]); // один атрібут id = 1
        foreach ($productsDb as $product){
            $product->product_attributes()->sync([1]);// один атрібут id = 1 для 5 продуктів
        }
        /*end prepare*/

        $filters = [
            'attribute' => '1'
        ];
//        dd($d);
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        $this->assertTrue($products->total() == 5);
    }
    public function test_filter_by_attributes_for_products_with_filter_class()
    {
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productsDb = factory(Product::class,5)->create(); // 5 products
        factory(Filter::class)->create(); // 1 group filter
        factory(Filter::class)->create(); // 2 group filter
        factory(Attribute::class)->create(
            ['id' => 1, 'filter_id'=>1]); // атрібут id = 1 group 1
        factory(Attribute::class)->create(
            ['id' => 2, 'filter_id'=>2]); // атрібут id = 2 group 2
        foreach ($productsDb as $product){
            $product->product_attributes()->sync([1,2]);// атрібут id = 1, 2 для 5 продуктів
        }
        /*end prepare*/


        $filters = [
            'attribute' => [
                1 => [1],
                2 => [2],
            ]
        ];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        $this->assertTrue($products->total() == 5);
    }
    public function test_filter_by_attributes_mach_variables_for_products_with_filter_class()
    {
        /*start prepare*/
        factory(Category::class)->create(); // category
        factory(Filter::class)->create(); // 1 group filter
        factory(Filter::class)->create(); // 2 group filter
        factory(Attribute::class)->create(
            ['id' => 1, 'filter_id'=>1]); // атрібут id = 1 group 1
        factory(Attribute::class)->create(
            ['id' => 2, 'filter_id'=>2]); // атрібут id = 2 group 2
        factory(Attribute::class)->create(
            ['id' => 3, 'filter_id'=>2]); // атрібут id = 3 group 2

        $productDb1 = factory(Product::class)->create(); // 1 product
        $productDb1->product_attributes()->sync([1,2]);// атрібут 1, 2 для 1 продукта

        $productDb2 = factory(Product::class)->create(); // 2 product
        $productDb2->product_attributes()->sync([2,3]);// атрібут 2, 3 для 2 продукта

        /*end prepare*/


        $filters = [
            'attribute' => [
                1 => [1],
                2 => [2],
            ]
        ];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
//        dump($products);
        $this->assertTrue($products->total() == 1);

        $filters2 = [
            'filter' => [
                2 => [2,3],
            ]
        ];
        $products2 = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters2);
        $this->assertTrue($products2->total() == 2);
    }
    public function test_filter_by_price_desc_for_products_with_filter_class()
    {
        $price = 1000;
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productDb1 = factory(Product::class)->create(['price' => ($price -rand(1,900))]); // 1 product
        $productDb2 = factory(Product::class)->create(['price' => ($price -rand(1,900))]); // 2 product
        $productDb2 = factory(Product::class)->create(['price' => $price]); // 3 product
        /*end prepare*/

        $filters = ['price' => 'desc'];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        foreach ($products as $product){
            $this->assertTrue($product->price == $price);
            $this->assertTrue($product->id == 3);
            break;
        }

    }
    public function test_filter_by_price_asc_for_products_with_filter_class()
    {
        $price = 1000;
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productDb1 = factory(Product::class)->create(['price' => ($price + rand(1,900))]); // 1 product
        $productDb2 = factory(Product::class)->create(['price' => ($price + rand(1,900))]); // 2 product
        $productDb2 = factory(Product::class)->create(['price' => $price]); // 3 product
        /*end prepare*/

        $filters = ['price' => 'asc'];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        foreach ($products as $product){
            $this->assertTrue($product->price == $price);
            $this->assertTrue($product->id == 3);
            break;
        }
    }
    // новинки
    public function test_filter_by_date_desc_for_products_with_filter_class()
    {
        $now = today();
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productDb1 = factory(Product::class)->create(['created_at' => today()->subDays(5)]); // 1 product
        $productDb2 = factory(Product::class)->create(['created_at' => today()->subDay()]); // 2 product
        $productDb2 = factory(Product::class)->create(['created_at' => $now]); // 3 product
        /*end prepare*/

        $filters = ['novelty' => 'desc'];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        foreach ($products as $product){
            $this->assertTrue($now->eq($product->created_at));
            $this->assertTrue($product->id == 3);
            break;
        }
    }
    // popular
    public function test_filter_by_popular_for_products_with_filter_class()
    {
        $visits = 100;
        /*start prepare*/
        factory(Category::class)->create(); // category
        $productDb1 = factory(Product::class)->create(['visits' => $visits-5]); // 1 product
        $productDb2 = factory(Product::class)->create(['visits' => $visits-10]); // 2 product
        $productDb2 = factory(Product::class)->create(['visits' => $visits]); // 3 product
        /*end prepare*/

        $filters = ['popular' => 'desc'];
        $products = (
        new GetProductsByLimit(
            new ProductsFilter(),
            new PaginateSession(Request::capture())
        )
        )->handel($filters);
        foreach ($products as $product){
            $this->assertTrue($product->visits == $visits);
            $this->assertTrue($product->id == 3);
            break;
        }
    }
}
