<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Lucid\Units\Job;

class GetOrdersJob extends Job
{
    public $where;

    public function __construct(array $where)
    {
        $this->where = $where;
    }

    public function handle(IOrderRepo $orderRepo)
    {

        return $orderRepo->findWhere($this->where);

    }
}
