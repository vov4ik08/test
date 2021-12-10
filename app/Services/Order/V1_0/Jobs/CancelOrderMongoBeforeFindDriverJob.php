<?php

namespace App\Services\Order\V1_0\Jobs;

use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\Order\V1_0\Domain\Request\CancelOrderRequest;
use Lucid\Units\Job;
use Taxi\Entity\OrderEntity;

class CancelOrderMongoBeforeFindDriverJob extends Job
{
    public function handle(CancelOrderRequest $request, IOrderRepo $orderRepo)
    {
        return $orderRepo->updateWhereNew(['status' => OrderEntity::STATUS_CANCEL_BY_USER], ['_id' => $request->get('id'), 'status' => 0]);

    }
}
