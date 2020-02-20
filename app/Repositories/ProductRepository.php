<?php

namespace App\Repositories;

use App\Product as Model;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Database\Query\Builder;
use DB;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function showWithPagination()
    {
        $product = Model::where('status', '=', '1');
        return $this->withPagination($product);
    }

    /**
     * Пошук по аліасу продукту
     * @param string $alias
     * @return mixed
     */
    public function findByAlias($alias)
    {
        return Model::with('comments')->where('alias', '=', $alias)->firstOrFail();
    }

    /**
     * Формування запитів на виборку по фільтрам та категорії
     * @param array $filters
     * @param int $category
     * @param string $sortBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function showProductsWithFormat($filters = [], $category = 0, $sortBy = '')
    {
        $products = Model::with('comments')->where('status', '=', '1');
        if ($filters){
            foreach ($filters as $f){
                $products = $products->whereExists(function ($query) use($f) {
                    $query->select(DB::raw(1))
                        ->from('attribute_product')
                        ->whereRaw('attribute_product.product_id = products.id')
                        ->whereIn('attribute_product.attribute_id', $f)
                    ;
                });
            }
        }
        if (is_integer($category)) {
            $products = $products->where('category_id', '=', $category);
        }elseif($category){
            $products = $products->join('categories', function ($join) use ($category){
                $join->on('products.category_id', '=', 'categories.id')
                    ->where('categories.slug', '=', $category);
            });
        }
        if ($sortBy) $products = $this->sortProducts($products, $sortBy);

        $products = $this->withPagination($products);
        return $products;
    }

    /**
     * Sorting
     * @param string $sorting
     * @param Builder $products
     * @return Builder $products
     *
     * */
    private function sortProducts($products, $sorting)
    {
        if ($sorting == 'price_asc'){
            $products = $products->orderBy('products.price', 'asc'); //от дешевых к дорогим
        }elseif ($sorting == 'price_desc'){
            $products = $products->orderBy('products.price', 'desc'); //от дорогих к дешевым
        //}elseif ($sorting == 'rating'){
//            $products = $products->orderBy('price', 'desc'); //по рейтингу
        }elseif ($sorting == 'new'){
            $products = $products->orderBy('products.created_at', 'asc'); //новинки
       // }elseif ($sorting == 'popular'){
//            $products = $products->orderBy('price', 'desc'); //популярные
        }
        return $products;
    }

    /**
     *
     * @param Builder $product
     * @param integer $pagination
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function withPagination($product, $pagination = 5)
    {
        return $product->paginate($pagination);
    }
}
