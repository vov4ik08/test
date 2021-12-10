<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use Lucid\Units\Job;

class OrderOptionJob extends Job
{
    public function handle(IOrderOptionRepo $orderOptionRepo)
    {
        return $orderOptionRepo->all();
    }
}
