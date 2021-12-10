<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Driver\V1_0\Domain\Request\AcceptOrderRequest;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Lucid\Units\Job;

class OrderDataJob extends Job
{
    public function handle(IOrderRepo $orderRepo, AcceptOrderRequest $request)
    {
        return $orderRepo->find($request->get('order_id'));
    }

}
