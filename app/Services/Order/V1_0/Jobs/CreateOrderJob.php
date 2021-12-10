<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Order\V1_0\Application\Request\CreateOrderRequest;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Lucid\Units\Job;

class CreateOrderJob extends Job
{
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function handle(IOrderRepo $orderRepo)
    {

       return $orderRepo->create($this->params);

    }
}
