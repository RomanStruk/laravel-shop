<?php


namespace App\Actions\Category;


use App\Tasks\Category\GetCategoryOrderByParentTask;

class GetCategoryOrderByAction
{
    public function run()
    {
        return (new GetCategoryOrderByParentTask())->get();
    }
}
