<?php


namespace App\Services\Driver\V1_0\Application\Features;


use Lucid\Units\Feature;

class GetNotificationFeature extends Feature
{
    public function handle()
    {
        return $this->run(\App\Services\Driver\V1_0\Domain\Jobs\GetNotificationJob::class);
    }
}
