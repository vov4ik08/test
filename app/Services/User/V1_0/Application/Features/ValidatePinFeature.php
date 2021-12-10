<?php


namespace App\Services\User\V1_0\Application\Features;



use App\Services\User\V1_0\Domain\Jobs\ValidatePinJob;
use Lucid\Units\Feature;

class ValidatePinFeature extends Feature
{
    public function handle()
    {
        $user = $this->run(ValidatePinJob::class);
//        event(new UpdateUserOrderEvent($user));
        return $user;

    }
}
