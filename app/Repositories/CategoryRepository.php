<?php


namespace App\Repositories;


use App\Category;

class CategoryRepository extends Repository
{
    public function findWhere($query)
    {
        return Category::with('parent')->where($query)->get();
    }

    public function all()
    {
        return Category::with('parent')
            ->where('parent_id', '=', 0)
            ->get();
    }
}
