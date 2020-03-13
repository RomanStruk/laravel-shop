<?php


namespace App\Services\Category;


use App\Category;

class GetCategories
{
    public function handel($root = true)
    {
        if ($root){
            return Category::with('children')
                ->with('parent')
                ->where('parent_id', '=', 0)
                ->get();
        }
        return Category::select(['id', 'slug', 'name'])->get();
    }
}
