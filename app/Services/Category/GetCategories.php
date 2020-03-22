<?php


namespace App\Services\Category;


use App\Category;

class GetCategories
{
    public function handel($onlyRoot = true)
    {
        if ($onlyRoot){
            return Category::with('children')
                ->with('parent')
                ->where('parent_id', '=', 0)
                ->get();
        }
        return Category::select(['id', 'slug', 'name'])->get();
    }
}
