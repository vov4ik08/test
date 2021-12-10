<?php

namespace App\Services\Order\V1_0\Jobs;

use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\Order\V1_0\Domain\Request\CancelOrderRequest;
use Kreait\Firebase\Database\Reference;
use Lucid\Units\Job;
use Taxi\Entity\OrderEntity;

class CancelByUserOrderRDJob extends Job
{
    public function handle(CancelOrderRequest $request)
    {
        $db = app('firebase.database');
        /**
         * @var $ref Reference
         */
        $ref = $db->getReference('UserOrders/' . $request->get('id'));
        $ref->update(['status' => -2]);
        $ref->remove();

    }
}
