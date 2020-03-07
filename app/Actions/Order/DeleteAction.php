<?php


namespace App\Actions\Order;


use App\Tasks\Order\DeleteTask;

class DeleteAction
{
    public function run($id)
    {
        (new DeleteTask())->delete($id);
    }
}
