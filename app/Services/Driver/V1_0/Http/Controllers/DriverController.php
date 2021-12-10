<?php


namespace App\Services\Driver\V1_0\Http\Controllers;


use App\Services\Driver\V1_0\Application\Features\DriverNearHoleFeature;
use App\Services\Driver\V1_0\Application\Features\DriverStartTripFeature;
use App\Services\Driver\V1_0\Application\Features\GetNotificationFeature;
use App\Services\Driver\V1_0\Application\Features\PingFeature;
use App\Services\Driver\V1_0\Application\Features\SetDefaultCarFeature;
use App\Services\Driver\V1_0\Application\Features\SetNavigationFeature;
use App\Services\Driver\V1_0\Domain\Request\PingRequest;
use App\Services\Driver\V1_0\Domain\Request\SetDefaultCarRequest;
use App\Services\Driver\V1_0\Domain\Request\SetNavigationRequest;
use Lucid\Units\Controller;

class DriverController extends Controller
{
    public function ping(PingRequest $request)
    {
        return $this->serve(PingFeature::class);
    }

    public function setDefaultCar(SetDefaultCarRequest $request)
    {
        return $this->serve(SetDefaultCarFeature::class);
    }

    public function notification()
    {
        return $this->serve(GetNotificationFeature::class);
    }

    public function setNavigation(SetNavigationRequest $request)
    {
        return $this->serve(SetNavigationFeature::class);
    }

    public function nearHole()
    {
        return $this->serve(DriverNearHoleFeature::class);
    }

    public function driverStartTrip()
    {
        return $this->serve(DriverStartTripFeature::class);
    }
}
