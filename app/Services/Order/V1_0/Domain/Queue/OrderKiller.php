<?php

namespace App\Services\Order\V1_0\Domain\Queue;

use App\Services\Driver\V1_0\Domain\Repo\IDriverOnlineRepo;
use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Database\Reference;
use Taxi\Entity\OrderEntity;

class OrderKiller implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    public  $backoff = 10;
    public $tries = 100;
    private OrderEntity $orderEntity;

    public function __construct(OrderEntity $orderEntity)
    {
        $this->orderEntity = $orderEntity;
    }

    public function handle(IOrderRepo $orderRepo)
    {
        $res = $orderRepo->updateWhereNew(['status' => OrderEntity::STATUS_CANCEL], ['_id' => $this->orderEntity->getAttribute('_id'), 'status' => 0]);
        if ($res) {
            $db = app('firebase.database');
            /**
             * @var $ref Reference
             */
            $ref = $db->getReference('UserOrders/' . $this->orderEntity->getAttribute('_id'));
            $ref->update(['status' => -1]);
            $ref->remove();
        }
    }
}
