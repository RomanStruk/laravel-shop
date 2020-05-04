<?php


namespace App\Services\Data\Product;


use App\Product;
use App\Services\PaginateSession;
use App\Services\ScopeFilters\ProductsFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetProductsByLimit
{
    /**
     * @var ProductsFilter
     */
    private $productsFilter;
    /**
     * @var PaginateSession
     */
    private $paginateSession;

    /**
     * GetProductsByLimit constructor.
     * @param ProductsFilter $productsFilter
     * @param PaginateSession $paginateSession
     */
    public function __construct(ProductsFilter $productsFilter, PaginateSession $paginateSession)
    {
        $this->productsFilter = $productsFilter;
        $this->paginateSession = $paginateSession;
    }

    /**
     * @param $filters
     * @param array $fields
     * @param bool $options
     * @return LengthAwarePaginator
     */
    public function handel($filters, $fields = ['*'], $options = true)
    {
        $limit = $this->paginateSession->getLimit();

        $product = Product::filter($this->productsFilter, $filters)->select($fields);

        if ($options){
            $product = $product->avgRating()
                ->with('category')
                ->with('media:media.id,media.url');
        }
        return $product->paginate($limit);
    }
}
