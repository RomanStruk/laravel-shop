<?php


namespace App\Actions\Category;


use App\Http\Requests\CategoryRequest;
use App\Tasks\Category\InsertCategoryTask;

class SaveCategoryAction
{
    public function run(CategoryRequest $request)
    {
        return (new InsertCategoryTask())->insert(
            $request->input('parent_id'),
            $request->input('name'),
            $request->input('slug'),
            $request->input('description')
        );
    }
}
