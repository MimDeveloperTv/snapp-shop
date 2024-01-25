<?php

namespace App\Listeners;

use App\Events\NotifyAdminEvent;
use App\Events\SmsEvent;
use App\Mail\NotifyAdminEmail;
use App\Models\Card;
use App\Models\Order;
use App\Services\Service;
use App\Services\ServiceFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSmsListener
{
    public function __construct()
    {}

    public function handle(SmsEvent $event): void
    {
        $user = Card::query()->find($event->cardId)->account()->first()->user()->first();
        $text =  sprintf($event->text,$event->amount);
        ServiceFactory::make(ServiceFactory::GHASEDAK)
            ->prepare($user->mobile,$text)->send();
    }
}
