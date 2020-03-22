<?php


namespace App\Tasks\Product;


use App\Product;
use App\Repositories\Filters\ProductsFilter;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class GetAllProductsTask
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = ProductRepository::getInstance();
    }

    public function get(array $request)
    {
        $products =  $this->repository->withFilters($request)->all();

        return $products;
    }
}
