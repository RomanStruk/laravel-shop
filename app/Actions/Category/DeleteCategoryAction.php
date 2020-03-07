<?php


namespace App\Actions\Category;


use App\Tasks\Category\DeleteCategoryTask;

class DeleteCategoryAction
{
    public function run($id)
    {
        return (new DeleteCategoryTask())->delete($id);
}
}
