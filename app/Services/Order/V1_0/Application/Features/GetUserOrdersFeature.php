<?php


namespace App\Services\Order\V1_0\Application\Features;


use App\Services\Driver\V1_0\Domain\Jobs\GetDriverByIdJob;
use App\Services\Driver\V1_0\Domain\Jobs\GetDriverJob;
use App\Services\Order\V1_0\Jobs\GetUserOrdersJob;
use Bobolink\Core\Helpers\ArrayHelper;
use Lucid\Units\Feature;

class GetUserOrdersFeature extends Feature
{
    public function handle()
    {

        $orders = $this->run(GetUserOrdersJob::class);
        $orders = $orders->toArray();
//        /**
//         * @var $order OrderEntity
//         */
        foreach ($orders as &$order) {
            if ($order['status'] > 0) {
                $driver = $this->run(GetDriverByIdJob::class, ['id' => $order['driver_id']]);
                $order['driver'] = $this->run(GetDriverJob::class, ['driverEntity' => $driver]);
                $order['car'] = ArrayHelper::findWhere($order['driver']['cars'], ['id' => $order['car_id']]);
            }
        }
        return $orders;
    }
}
