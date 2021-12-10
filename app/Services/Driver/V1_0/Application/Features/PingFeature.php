<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\PingJob;
use Lucid\Units\Feature;

class PingFeature extends Feature
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return $this->run(PingJob::class);
    }
}
