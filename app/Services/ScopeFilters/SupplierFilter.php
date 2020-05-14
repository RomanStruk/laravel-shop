<?php


namespace App\Services\ScopeFilters;


class SupplierFilter extends BaseFilter
{

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

}
