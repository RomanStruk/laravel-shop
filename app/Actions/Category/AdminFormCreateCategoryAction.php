<?php


namespace App\Actions\Category;


use App\Tasks\Category\GetCategoriesTask;

class AdminFormCreateCategoryAction
{
    public function run()
    {
        return [
            'category' => [],
            'categories' => (new GetCategoriesTask())->get(),
            'delimiter' => ''
        ];
    }

}
