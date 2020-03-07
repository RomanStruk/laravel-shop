<?php
namespace App\Actions\Order;

use App\Http\Requests\StatusOrderRequest;
use App\Tasks\Order\InsertNewOrderStatusTask;

class UpdateOrderStatusAction
{
    public function run(StatusOrderRequest $request, $orderId)
    {
        $input = $request->only(['status', 'comment']);
        return (new  InsertNewOrderStatusTask())->insert($orderId, $input);

    }
}
