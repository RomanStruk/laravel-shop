<?php


namespace App\Services\Data\Category;



use App\Category;

class DeleteCategory
{

    public function handel($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
