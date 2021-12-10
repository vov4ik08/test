<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\SetNavigationJob;
use Lucid\Units\Feature;

class SetNavigationFeature extends Feature
{
    public function handle()
    {
        return $this->run(SetNavigationJob::class);
    }
}
