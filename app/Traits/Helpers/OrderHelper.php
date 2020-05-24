<?php


namespace App\Traits\Helpers;


use App\Notifications\OrderCreatedMailNotificationForUser;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderStatusChangeNotification;
use App\OrderHistory;
use App\OrderProduct;
use App\Product;
use App\Services\Shipping\ShippingBase;
use App\Shipping;
use Illuminate\Notifications\Notification;

/**
 * @property-read \App\Payment $payment
 */
trait OrderHelper
{

    public function getSumPriceAttribute()
    {
        return $this->getSubTotalPrice();
    }


    /**
     *
     * Calculated sum price for products
     *
     * @return mixed
     */
    public function getSubTotalPrice()
    {
        return $this->orderProducts->sum(function ($orderProduct) {
            return $orderProduct->product->price * $orderProduct->count;
        });
    }

    /**
     *
     * Calculated sum price for order
     *
     * @return mixed
     */
    public function getTotalPrice()
    {
        $sum = $this->orderProducts->sum(function ($orderProduct) {
            return $orderProduct->product->price * $orderProduct->count;
        });
        return $sum + $this->shipping->shipping_rate;
    }

    /**
     * Updating products
     *
     * @param array $fields
     * @return mixed
     */
    public function syncProducts(array $fields)
    {
        $this->orderProducts()->delete();;
        return $this->orderProducts()->createMany($fields);

    }

    /**
     * Creating payment fields
     *
     * @param array $fields
     * @return mixed
     */
    public function paymentCreate(array $fields)
    {
        return $this->payment()->create($fields);
    }

    /**
     *
     * Creating shipping fields
     *
     * @param array $fields
     * @return mixed
     */
    public function shippingCreate(array $fields)
    {
        $shipping = new Shipping();
        $shipping->method   = $fields['method'];
        $shipping->shipping_rate   = $fields['shipping_rate'];

        $shipping->city     =  $fields['city'];
        $shipping->address  = $fields['address'];

        return $this->shipping()->save($shipping);

    }

    /**
     * Updating payment fields
     *
     * @param array $fields
     * @return mixed
     */
    public function paymentUpdate(array $fields)
    {
//        $a = array_intersect_key($fields, array_flip($this->payment->fillable));
        return $this->payment()->update($fields);
    }

    /**
     *
     * Updating shipping fields
     *
     * @param array $fields
     * @return mixed
     */
    public function shippingUpdate(array $fields)
    {

        $this->shipping->method   = $fields['method'];
        $this->shipping->shipping_rate   = $fields['shipping_rate'];
        $this->shipping->city     = $fields['city'];
        $this->shipping->address  = $fields['address'];

        return $this->shipping->save();
    }

    public function statusUpdate(array $fields)
    {
        $orderHistory = new OrderHistory([
            'status' => $fields['status'],
            'user_id' => \Auth::user()->id,
            'comment' => $fields['comment']
        ]);
        $this->histories()->save($orderHistory);
        return $this->update(['status' => $fields['status']]);
    }

    /**
     * Send notification.
     *
     * @return void
     */
    public function SendEmailForUserAboutNewOrderNotification()
    {
        $this->notify(
            (new OrderCreatedMailNotificationForUser(
                $this->id, $this->user, $this->products, $this->payment, $this->shipping)
            )->onQueue('default')
        );
    }

    /**
     * Save to db notification.
     *
     * @return void
     */
    public function orderCreatedNotificationForAdmin()
    {
        $this->notify(new OrderCreatedNotification($this->id));
    }

    /**
     * Save to db notification.
     *
     * @return void
     */
    public function orderChangeStatusMailNotification()
    {
        $this->notify(
            (new OrderStatusChangeNotification(
                $this->user->fullName,
                $this->orderProducts,
                $this->id,
                $this->getStatus($this->status))
            )->onQueue('default')

        );
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->user->email; // Return email address only...
    }
}
