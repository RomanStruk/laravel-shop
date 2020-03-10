<?php


namespace App\Repositories\Filters;


class ProductsFilter extends BaseFilter
{

    public function titleFilter($value)
    {
        $this->builder->where('title', 'like', "%$value%");
    }

    public function statusFilter($value)
    {
        $this->builder->where('status', '=', $value);
    }
}
