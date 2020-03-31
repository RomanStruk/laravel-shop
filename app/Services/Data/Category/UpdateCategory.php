<?php


namespace App\Services\Data\Category;
use App\Category;

class UpdateCategory
{

    /**
     * @param $id
     * @param $update
     * @return bool
     */
    public function handel($id, $update)
    {
        $category = Category::findOrFail($id);
        return $category->update([
            'parent_id' => $update['parent_id'],
            'name' => $update['name'],
            'slug' => $update['slug'],
            'description' => $update['description']
        ]);
}
}
