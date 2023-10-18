<?php

namespace App\Providers;

use App\Events\CustomerSeated;
use App\Events\OrderCreate;
use App\Events\RestaurantCreatedEvent;
use App\Listeners\EmptyCart;
use App\Listeners\MigrateDatabaseListener;
use App\Listeners\NotifyAdminOnCustomerSeated;
use App\Listeners\SendNotificationToAdminOnOrderCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RestaurantCreatedEvent::class => [
            MigrateDatabaseListener::class,
        ],
        CustomerSeated::class => [
            NotifyAdminOnCustomerSeated::class
        ],
        OrderCreate::class => [
            SendNotificationToAdminOnOrderCreated::class,
            EmptyCart::class,
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
