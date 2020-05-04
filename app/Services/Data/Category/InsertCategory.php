<?php


namespace App\Services\Data\Category;


use App\Category;

class InsertCategory
{
    public function handel($insert)
    {
        $category = new Category([
            'parent_id' => $insert['parent_id'],
            'name' => $insert['name'],
            'slug' => $insert['slug'],
            'description' => $insert['description']
        ]);
        $category->save();
        return $category;
    }
}
