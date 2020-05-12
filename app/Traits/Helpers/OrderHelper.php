<?php


namespace App\Traits\Helpers;


use App\Notifications\OrderCreatedMailNotificationForUser;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderStatusChangeNotification;
use App\OrderHistory;
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
     * Calculated sum price for one product
     *
     * @param $productId
     * @return float|int
     */
    public function getTotalPriceForProduct($productId)
    {
        $product = $this->products->find($productId);
        return $product->price * $product->pivot->count;
    }

    /**
     *
     * Calculated sum price for products
     *
     * @return mixed
     */
    public function getSubTotalPrice()
    {
        return $this->products->sum(function ($product) {
            return $product->price*$product->pivot->count;
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
        $sum = $this->products->sum(function ($product) {
            return $product->price*$product->pivot->count;
        });
        return $sum + $this->shipping->shipping_rate;
    }

    /**
     * Updating products
     *
     * @param array $fields
     */
    public function syncProducts(array $fields)
    {
        $this->products()->sync($fields['products']);
        $this->load('products');
        foreach ($fields['products'] as $key => $product) {
            if ($this->products->contains($product)){
                $pivot = $this->products()->where('product_id', $product)->first()->pivot;
                $pivot->count = array_key_exists($key, $fields['count'])? $fields['count'][$key]: 1;
                $pivot->update();
            }
        }
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
                $this->products,
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
