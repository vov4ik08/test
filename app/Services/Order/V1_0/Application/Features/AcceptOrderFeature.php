<?php


namespace App\Services\Order\V1_0\Application\Features;


use App\Services\Order\V1_0\Jobs\AcceptOrderErrorJob;
use App\Services\Order\V1_0\Jobs\AcceptOrderJob;
use App\Services\Order\V1_0\Jobs\AddDriverNextOrderJob;
use App\Services\Order\V1_0\Jobs\CheckDriverHasOrder;
use App\Services\Order\V1_0\Jobs\OrderDataJob;
use App\Services\Order\V1_0\Jobs\PrepareFireBaseOrderDataJob;
use App\Services\Order\V1_0\Jobs\SetDriverCurrentOrder;
use Lucid\Units\Feature;
use Taxi\Entity\DriverEntity;
use Taxi\Entity\OrderEntity;

class AcceptOrderFeature extends Feature
{
    public function handle()
    {
        /**
         * @var $driver DriverEntity
         */
        $driver = \Illuminate\Support\Facades\Auth::user();
        $acceptOrder = $this->run(AcceptOrderJob::class, ['driverId' => $driver->getAuthIdentifier()]);
        if ($acceptOrder) {
            $driverIsFree = $this->run(CheckDriverHasOrder::class);
            /**
             * @var $order OrderEntity
             */
            $order = $this->run(OrderDataJob::class);

            if (empty($order)) {
                $this->run(AcceptOrderErrorJob::class);
                return false;
            }
            $fireBaseOrderData = $this->run(PrepareFireBaseOrderDataJob::class, ['order' => $order]);


            if ($driverIsFree) {
                $this->run(SetDriverCurrentOrder::class, ['fireBaseOrderData' => $fireBaseOrderData]);
                return true;

            } else {
                $this->run(AddDriverNextOrderJob::class);
                return true;
            }


        } else {
            $this->run(AcceptOrderErrorJob::class);
            return false;
        }
    }
}
