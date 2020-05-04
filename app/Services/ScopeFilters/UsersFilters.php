<?php


namespace App\Services\ScopeFilters;


use Carbon\Carbon;

class UsersFilters extends BaseFilter
{
    protected $filtersProtected = ['trashed'];

    public function dateDescFilter($value)
    {
        $this->builder->orderByDesc('created_at');
    }

    public function statusFilter($value)
    {
        if (! is_numeric($value)) return ;

        if ($value < 0) return ;

        $this->builder->whereHas('detail', function ($query) use($value) {
            $query->where('user_details.status', $value);
        });
    }

    public function dateAddedFilter($value)
    {
//        dd($value);
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $this->builder->whereBetween('created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()]); //date modified
    }

    public function searchFilter($value)
    {
        $this->builder->where('email', 'like', "%$value%")
            ->orWhereHas('detail', function ($builder) use($value){
                foreach (explode(' ', $value) as $key){
                    $builder->where('first_name', 'like', "%$key%")
                        ->orWhere('last_name', 'like', "%$key%");
                }
            });
    }
}
