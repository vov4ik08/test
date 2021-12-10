<?php


namespace App\Services\Driver\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\GetDriverJob;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Feature;

class GetDriverFeature extends Feature
{
    public function handle()
    {
        return $this->run(GetDriverJob::class, ['driverEntity' => Auth::user()]);

    }
}
