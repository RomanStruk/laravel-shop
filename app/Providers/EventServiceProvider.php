<?php

namespace App\Providers;

use App\Events\ChangeOrderStatusEvent;
use App\Events\OrderCreatedEvent;
use App\Listeners\CreateFirstEntryToOrderHistory;
use App\Listeners\NotificationForAdminAboutNewOrder;
use App\Listeners\OrderChangeStatusListener;
use App\Listeners\SendEmailForUserAboutNewOrder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ChangeOrderStatusEvent::class => [
            OrderChangeStatusListener::class
        ],

        OrderCreatedEvent::class => [
            CreateFirstEntryToOrderHistory::class, // перший запис в бд про історію замовлення
            SendEmailForUserAboutNewOrder::class, // Відправити лист з інформацією про замовлення користувачу
            NotificationForAdminAboutNewOrder::class // Сповіщення для адміна про нове замовлення
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
