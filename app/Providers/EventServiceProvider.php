<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\TicketReply;
use App\Models\User;
use App\Observers\OrderObserver;
use App\Observers\OrderStatusObserver;
use App\Observers\TicketReplyObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        OrderStatus::observe(OrderStatusObserver::class);
        TicketReply::observe(TicketReplyObserver::class);
        User::observe(UserObserver::class);
    }
}
