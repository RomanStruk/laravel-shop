<?php


namespace App\Services\Data\Category;


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
        return Category::select(['id', 'slug', 'name', 'parent_id', 'description'])
            ->with('parent')
            ->paginate();
    }
}
