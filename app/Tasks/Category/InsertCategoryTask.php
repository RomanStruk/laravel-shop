<?php


namespace App\Tasks\Category;


use App\Category;

class InsertCategoryTask
{
    public function insert($parent_id, $name, $slug, $description)
    {
        $category = new Category([
            'parent_id' => $parent_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);
        $category->save();
        return $category->id;
    }
}
