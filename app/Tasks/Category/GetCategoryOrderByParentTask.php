<?php


namespace App\Tasks\Category;


use App\Category;

class GetCategoryOrderByParentTask
{
    public function get()
    {
        return Category::with('parent')
            ->orderBy('parent_id')
            ->get();
    }
}
