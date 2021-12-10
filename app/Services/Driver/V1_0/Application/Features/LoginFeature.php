<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\LoginJob;
use Lucid\Units\Feature;

class LoginFeature extends Feature
{
    public function handle()
    {
        return  $this->run(LoginJob::class);

    }
}
