<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\User\V1_0\Domain\Repo\ITaxiTypeRepository;
use Lucid\Units\Job;

class LoadTaxiTypeJob extends Job
{
    public function handle(ITaxiTypeRepository $taxiTypeRepository)
    {
        return $taxiTypeRepository->all();
    }
}
