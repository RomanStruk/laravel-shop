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

    public function handel($filters, $limit = 10)
    {
        return Product::filter($this->productsFilter, $filters)
            ->with('category')
            ->paginate($limit);
    }
}
