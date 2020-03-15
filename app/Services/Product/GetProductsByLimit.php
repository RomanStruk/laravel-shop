<?php


namespace App\Services\Product;


use App\Product;
use App\Repositories\Filters\ProductsFilter;
use App\Tasks\Product\GetAllProductsTask;

class GetProductsByLimit
{
    /**
     * @var ProductsFilter
     */
    private $productsFilter;

    /**
     * GetProductsByLimit constructor.
     * @param ProductsFilter $productsFilter
     */
    public function __construct(ProductsFilter $productsFilter)
    {
        $this->productsFilter = $productsFilter;
    }

    /**
     * @param $filters
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function handel($filters, $limit = 10)
    {
        return Product::filter($this->productsFilter, $filters)
            ->with('category')
            ->with('media:media.id,media.url')
            ->paginate($limit);
    }
}
