<?php


namespace App\Actions\Category;


use App\Tasks\Category\GetCategoriesTask;
use App\Tasks\Category\GetCategoryBySlugOrIdTask;

class FormEditCategoryAction
{
    public function run(int $id)
    {
        return [
            'category' => (new GetCategoryBySlugOrIdTask())->get($id),
            'categories' => (new GetCategoriesTask())->get(),
            'delimiter' => ''
        ];
    }
}
