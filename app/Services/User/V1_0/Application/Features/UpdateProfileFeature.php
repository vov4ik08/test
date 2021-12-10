<?php

namespace App\Services\User\V1_0\Application\Features;

use App\Services\User\V1_0\Domain\Jobs\UpdateProfileJob;
use Lucid\Units\Feature;

class UpdateProfileFeature extends Feature
{
    public function handle()
    {
        return $this->run(UpdateProfileJob::class);
    }
}
