<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\SetDefaultCarJob;
use Lucid\Units\Feature;

class SetDefaultCarFeature extends Feature
{
    public function handle()
    {
            return $this->run(SetDefaultCarJob::class);
    }
}
