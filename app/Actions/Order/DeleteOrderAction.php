<?php


namespace App\Actions\Order;


use App\Tasks\Order\DeleteTask;

class DeleteOrderAction
{
    public function run($id)
    {
       return (new DeleteTask())->delete($id);
    }
}
