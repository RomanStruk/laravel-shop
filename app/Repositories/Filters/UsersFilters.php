<?php


namespace App\Repositories\Filters;


class UsersFilters extends BaseFilter
{
    protected $filtersProtected = ['trashed'];

    public function statusFilter($value)
    {
        if (! is_numeric($value)) return ;

        $this->builder->where('status', '=', (int)$value);
    }
}
