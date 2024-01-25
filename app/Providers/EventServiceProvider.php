<?php

namespace App\Providers;

use App\Events\SmsEvent;
use App\Listeners\SendSmsListener;
use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\WageTransaction;
use App\Observer\UlidKeyObserver;
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
            SmsEvent::class => [
                SendSmsListener::class,
            ]
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Account::observe(UlidKeyObserver::class);
        Card::observe(UlidKeyObserver::class);
        Transaction::observe(UlidKeyObserver::class);
        WageTransaction::observe(UlidKeyObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return true;
    }
}
