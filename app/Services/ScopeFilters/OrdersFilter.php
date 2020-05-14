<?php


namespace App\Services\ScopeFilters;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class OrdersFilter extends BaseFilter
{
    public function dateDescFilter($value)
    {
        $this->builder->orderByDesc('created_at');
    }

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
        $this->builder->where(function (Builder $builder) use($value) {
            return $builder->orWhereHas('orderProducts.product', function ($builder) use($value){
                /** @var Builder $builder */
                $builder->where('title', 'like', "%$value%");
            })->orWhereHas('user', function ($builder) use($value){
                /** @var Builder $builder */
                $builder->where('email', 'like', "%$value%")
                    ->orWhereHas('detail', function ($builder) use($value){
                        foreach (explode(' ', $value) as $key){
                            $builder->where('first_name', 'like', "%$key%")
                                ->orWhere('last_name', 'like', "%$key%");
                        }
                    });
            });
        });
    }
}
