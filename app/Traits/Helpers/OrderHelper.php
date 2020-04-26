<?php


namespace App\Traits\Helpers;


use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderStatusChangeNotification;
use Illuminate\Notifications\Notification;
use Str;

/**
 * @property-read \App\Payment $payment
 */
trait OrderHelper
{
    public function addProduct($id)
    {
        if ($this->products->contains($id)){
            $pivot = $this->products()->where('product_id', $id)->first()->pivot;
            $pivot->count ++;
            $pivot->update();
        }else{
            $this->products()->attach($id);
        }
    }

    public function subProduct($id)
    {
        if ($this->products->contains($id)){
            $pivot = $this->products()->where('product_id', $id)->first()->pivot;
            if($pivot->count() > 1){
                $pivot->count --;
                $pivot->update();
            }else{
                $this->products()->detach($id);
            }
        }
    }
    /**
     * Updating products
     *
     * @param array $fields
     * @return mixed
     */
    public function syncProducts(array $fields)
    {

        $this->products()->sync($fields['products']);
        foreach ($fields['products'] as $key => $product) {
            if ($this->products->contains($product)){
                $pivot = $this->products()->where('product_id', $product)->first()->pivot;
                $pivot->count = array_key_exists($key, $fields['count'])? $fields['count'][$key]: 1;
                $pivot->update();
            }
        }

        return ;
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
        return $this->shipping()->update($fields);
    }

    /**
     * Save to db notification.
     *
     * @return void
     */
    public function orderCreatedNotification()
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
