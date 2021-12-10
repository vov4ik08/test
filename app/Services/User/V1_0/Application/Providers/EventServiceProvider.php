<?php


namespace App\Services\User\V1_0\Application\Providers;


use App\Services\User\V1_0\Domain\Listeners\UserEventSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        UserEventSubscriber::class
    ];
}
