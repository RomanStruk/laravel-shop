<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter
{
    /**
     * @var Builder $builder
     */
    protected $builder;
    protected $request;

    protected $filtersProtected = [];
    /**
     * BaseFilter
     * @param Builder $builder
     * @param array $request
     * @return Builder
     */
    public function apply(Builder $builder, array $request)
    {
        $this->builder = $builder;
        $this->request = $request;
        foreach ($this->filters() as $name => $value){
            if ($value == '') continue;
            if (in_array($name, $this->filtersProtected) and !\Auth::check()) continue; //TODO Guardian for filters

            if (method_exists($this, $name.'Filter')){
                $this->{$name.'Filter'}($value);
            }
        }
        return $this->builder;
    }

    public function filters()
    {
        return $this->request;
    }


}
