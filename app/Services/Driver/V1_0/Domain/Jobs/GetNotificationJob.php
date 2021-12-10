<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Infrastructure\Presenters\DriverPresenter;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;
use Taxi\Entity\DriverEntity;

class GetNotificationJob extends Job
{
    public function handle()
    {
        /**
         * @var $driver DriverEntity
         */
        $driver = Auth::user();
        $notification = $driver->notification()->get();

//        $driver->setPresenter(new DriverPresenter());
//        $driver = $driver->presenter();
//        $driver = $driver['data'];
        return $notification->toArray();
    }
}
