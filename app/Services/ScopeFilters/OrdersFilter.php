<?php


namespace App\Services\ScopeFilters;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class OrdersFilter extends BaseFilter
{
    public function statusFilter($value)
    {
        if (! is_numeric($value)) return ;

        $this->builder->where('status', (int)$value);
    }

    /**
     * date modified
     *
     * @param $value
     */
    public function dateModifiedFilter($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $this->builder->whereBetween('updated_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()]);
    }

    /**
     * date created
     *
     * @param $value
     */
    public function dateAddedFilter($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $this->builder->whereBetween('created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()]);
    }

    public function searchFilter($value)
    {
        $this->builder->whereHas('products', function ($builder) use($value){
            /** @var Builder $builder */
            $builder->where('title', 'like', "%$value%");
        });
    }
}
