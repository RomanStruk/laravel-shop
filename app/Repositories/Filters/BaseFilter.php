<?php


namespace App\Repositories\Filters;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    protected $builder;
    protected $request;

    /**
     * BaseFilter constructor.
     * @param Builder $builder
     * @param array $request
     */
    public function __construct(Builder $builder, array $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply()
    {
        foreach ($this->filters() as $name => $value){
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
