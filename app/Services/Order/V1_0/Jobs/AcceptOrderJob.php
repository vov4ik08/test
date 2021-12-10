<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Driver\V1_0\Domain\Request\AcceptOrderRequest;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Lucid\Units\Job;

class AcceptOrderJob extends Job
{
    private $driverId;

    public function __construct($driverId)
    {
        $this->driverId = $driverId;
    }

    public function handle(AcceptOrderRequest $request, IOrderRepo $orderRepo)
    {

        return $orderRepo->updateWhereNew(['status' => 1, 'driver_id' => $this->driverId], ['_id' => $request->get('order_id'), 'status' => 0]);
    }
}
