<?php

namespace App\Services\Data\Order;

use App\Order;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteOrder
{
    public function handel($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $order->delete();
        } catch (Exception $e) {
            throw new ModelNotFoundException();
        }
    }
}
