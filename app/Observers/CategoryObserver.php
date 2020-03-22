<?php

namespace App\Observers;

use App\Category;
use Str;

class CategoryObserver
{
    /**
     * @param Category $category
     */
    public function slug(Category $category)
    {
        if (empty($category->slug)){
            $category->slug = Str::slug($category->name). rand(1,99);
        }
    }
    /**
     * Handle the category "creating" event.
     *
     * @param Category $category
     * @return void
     */
    public function creating(Category $category)
    {
        $this->slug($category);
    }

    /**
     * Handle the category "updating" event.
     *
     * @param Category $category
     * @return void
     */
    public function updating(Category $category)
    {
        $this->slug($category);
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Category::where('parent_id', $category->id)->update(['parent_id' => 0]);
    }
}
