<?php


namespace App\Services\ScopeFilters;


use Carbon\Carbon;

class ProductsFilter extends BaseFilter
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
            $this->builder->where('title', 'like', "%$value%");
        }
    }

    public function statusFilter($value)
    {
        if (! is_numeric($value)) return ;


        $this->builder->where('status', '=', (int)$value);
    }

    public function categoryFilter($value)
    {
        if (is_numeric($value)){
            $this->builder->where('category_id', '=', $value);
        }elseif($value){

            $this->builder->whereExists(function ($query) use($value) {
                $query->select(\DB::raw(1))
                    ->from('categories')
                    ->whereRaw('products.category_id = categories.id')
                    ->whereRaw(sprintf("categories.slug = '%s'", $value))
                ;
            });
        }
    }

    public function attributeFilter($value)
    {
        if (! is_array($value)) $value = array($value);
        foreach ($value as $f){
            if (! is_array($f)) $f = array($f);
            $this->builder->whereHas('product_attributes', function ($query) use($f) {
                $query->whereIn('attributes.id', $f);
            });
        }
//        dd($value);
    }

    public function priceFilter($value = 'desc')
    {
        $this->builder->orderBy('products.price', $value); //от дорогих к дешевым
    }

    public function ratingFilter($value)
    {
        $this->builder->orderByDesc('average_rating');
    }

    public function noveltyFilter($value)
    {
        $this->builder->orderBy('products.created_at', 'desc'); //новинки
    }

    public function popularFilter($value)
    {
        $this->builder->orderBy('visits', 'desc'); //популярные
    }

    public function dateFilter($value)
    {
        $this->builder->orderBy('created_at', 'desc'); //date
    }

    public function idFilter($value)
    {
        $this->builder->where('id', $value); //id
    }

    public function modifiedFilter($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $this->builder->whereBetween('updated_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()]); //date modified
    }

    public function dateAddedFilter($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value);
        $this->builder->whereBetween('created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()]); //date modified
    }

    public function trashedFilter($value)
    {
        $this->builder->withTrashed(); //withTrashed
    }
}
