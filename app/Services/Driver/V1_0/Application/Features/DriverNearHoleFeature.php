<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\SetDriverNearHoleJob;
use App\Services\User\V1_0\Domain\Jobs\FcmJob;
use Lucid\Units\Feature;
use function abort;

class DriverNearHoleFeature extends Feature
{
    public function handle()
    {
        $res = $this->run(SetDriverNearHoleJob::class);
        if (!empty($res)) {
            $hashText[$res['user_fire_base_token']] = ['title' => 'Водитель прибыл', 'body' => 'Водитель уже ожидает Вас, пожалуйста выходите. Безоплатное время ожиданиея 5 минут.'];
            $this->run(FcmJob::class, ['hashText' => $hashText]);
            return true;
        }
        abort(500, 'Set driver in hole error');

    }
}
