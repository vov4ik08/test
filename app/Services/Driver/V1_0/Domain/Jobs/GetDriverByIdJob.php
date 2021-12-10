<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use Lucid\Units\Job;
use Taxi\Entity\OrderEntity;

class GetDriverByIdJob extends Job
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle(IDriverRepo $driverRepo)
    {
        return $driverRepo->find($this->id);
    }
}
