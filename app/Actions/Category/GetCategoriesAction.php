<?php


namespace App\Actions\Category;


use App\Tasks\Category\GetCategoriesTask;

class GetCategoriesAction
{
    public function run()
    {
        return (new GetCategoriesTask())->get();
}
}
