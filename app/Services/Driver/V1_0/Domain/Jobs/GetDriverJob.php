<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Infrastructure\Presenters\DriverPresenter;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;
use Taxi\Entity\DriverEntity;

class GetDriverJob extends Job
{
    public DriverEntity $driverEntity;

    public function __construct(DriverEntity $driverEntity)
    {
        $this->driverEntity = $driverEntity;
    }

    public function handle()
    {
        /**
         * @var $driver DriverEntity
         */
//        $driver = Auth::user();
        $profile = $this->driverEntity->profile()->get();
        $cars = $this->driverEntity->cars()->with(['carMark', 'carModel'])->orderBy('id')->get();
//        $notification = $driver->notification()->get();
        $this->driverEntity->setPresenter(new DriverPresenter());
        $driver = $this->driverEntity->presenter();
        $driver = $driver['data'];
        $driver['profile'] = $profile->first()->toArray();
        $driver['cars'] = $cars->toArray();
//        $driver['notification'] = $notification->toArray();
        return $driver;
    }
}
