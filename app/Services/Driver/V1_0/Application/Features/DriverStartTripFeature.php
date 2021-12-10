<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\DriverStartTripJob;
use App\Services\Driver\V1_0\Domain\Request\DriverStartTripRequest;
use App\Services\User\V1_0\Domain\Jobs\FcmJob;
use Lucid\Units\Feature;
use function abort;

class DriverStartTripFeature extends Feature
{
    public function handle(DriverStartTripRequest $request)
    {
        $res = $this->run(DriverStartTripJob::class);
        if (!empty($res)) {
            $hashText[$res['user_fire_base_token']] = ['title' => 'Вы начали поездку', 'body' => 'Хорошой дороги'];
            $this->run(FcmJob::class, ['hashText' => $hashText]);
            return true;
        }
        abort(500, 'Start trip error');
    }
}
