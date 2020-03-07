<?php


namespace App\Actions\Category;


use App\Tasks\Category\GetCategoryBySlugOrIdTask;

class GetCategoryAction
{
    public function run(int $id)
    {
        return (new GetCategoryBySlugOrIdTask())->get($id);
    }
}
