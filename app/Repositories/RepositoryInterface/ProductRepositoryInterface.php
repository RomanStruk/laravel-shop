<?php

namespace App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function showWithPagination();

    /**
     * Пошук по аліасу продукту
     * @param string $alias
     * @return mixed
     */
    public function findByAlias($alias);

    /**
     * Формування запитів на виборку по фільтрам та категорії
     * @param array $filters
     * @param int $category
     * @param string $sortBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function showProductsWithFormat($filters = [], $category = 0, $sortBy = '');
}
