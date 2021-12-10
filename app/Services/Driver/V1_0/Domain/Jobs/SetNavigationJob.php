<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Request\SetNavigationRequest;
use App\Services\Driver\V1_0\Infrastructure\Repo\DriverRepo;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class SetNavigationJob extends Job
{
    public function handle(SetNavigationRequest $request, DriverRepo $driverRepo)
    {
        return $driverRepo->updateWhereNew([
            'navigation' => json_encode(['map_type' => $request->get('map_type'), 'map_name' => $request->get('map_name')])],
            ['id' => Auth::id()]);
    }
}
