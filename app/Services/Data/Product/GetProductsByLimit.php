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
     * @return LengthAwarePaginator
     */
    public function handel($filters, $fields = ['*'])
    {
        $limit = $this->paginateSession->getLimit();

        return Product::filter($this->productsFilter, $filters)
            ->select($fields)
            ->with('category')
            ->with('media:media.id,media.url')
            ->paginate($limit);
    }
}
