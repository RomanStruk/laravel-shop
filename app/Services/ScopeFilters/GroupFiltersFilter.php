<?php


namespace App\Services\ScopeFilters;



class GroupFiltersFilter extends BaseFilter
{

    protected $filtersProtected = ['trashed'];

    /**
     * @param $value
     */
    public function searchFilter($value)
    {
        if (is_numeric($value)){
            $this->builder->where('id', '=', $value);
        }else{
            $this->builder->where('name', 'like', "%$value%");
        }
    }

    public function trashedFilter($value)
    {
        $this->builder->withTrashed(); //withTrashed
    }

    public function excludeFilter($value)
    {
        $this->builder->whereNotIn('id', $value);
    }
}
