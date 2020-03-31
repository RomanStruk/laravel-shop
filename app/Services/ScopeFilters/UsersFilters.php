<?php


namespace App\Services\ScopeFilters;


use Carbon\Carbon;

class UsersFilters extends BaseFilter
{
    protected $filtersProtected = ['trashed'];

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
        $this->builder->where('email', $value);
    }
}
