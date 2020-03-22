<?php


namespace App\Actions\Category;


use App\Http\Requests\CategoryRequest;
use App\Tasks\Category\InsertCategoryTask;
use App\Tasks\Category\UpdateCategoryTask;

class UpdateCategoryAction
{
    public function run(CategoryRequest $request, $id)
    {
        return (new UpdateCategoryTask())->update(
            $id,
            $request->input('parent_id'),
            $request->input('name'),
            $request->input('slug'),
            $request->input('description')
        );
}
}
