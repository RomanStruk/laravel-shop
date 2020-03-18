<?php


namespace App\Repositories\Filters;


class ProductsFilter extends BaseFilter
{

    /**
     * @param $value
     */
    public function titleFilter($value)
    {
        $this->builder->where('title', 'like', "%$value%");
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
}
