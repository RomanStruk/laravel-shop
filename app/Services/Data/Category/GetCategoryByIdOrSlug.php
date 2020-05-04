<?php


namespace App\Services\Data\Category;


use App\Category;

class GetCategoryByIdOrSlug
{
    public function handel($idOrSlug)
    {
        $query = is_numeric($idOrSlug) ? ['id' => $idOrSlug] : ['slug' => $idOrSlug];

        return Category::with('parent')->where($query)->get()->first();
    }
}
