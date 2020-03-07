<?php


namespace App\Tasks\Category;


use App\Category;

class UpdateCategoryTask
{
    public function update($id, $parent_id, $name, $slug, $description)
    {
        $category = Category::findOrFail($id);
        return $category->update([
            'parent_id' => $parent_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);
}
}
