<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Request\PingRequest;
use App\Services\Driver\V1_0\Domain\Repo\IDriverOnlineRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class PingJob extends Job
{
    public function handle(PingRequest $request, IDriverOnlineRepo $driverOnlineRepo): string
    {
        $driverId = Auth::id();
        $params = [
            'driver_id' => $driverId,
            'location' => ['type' => 'Point', 'coordinates' => [floatval($request->get('lng')), floatval($request->get('lat'))]]
        ];
        $res = $driverOnlineRepo->updateWhereNew($params,
            ['driver_id' => $driverId]
        );

        if (!$res) {
            $driverOnlineRepo->create($params);
//            abort(404);
        }
        return "pong";
    }
}
