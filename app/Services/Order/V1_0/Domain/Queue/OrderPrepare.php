<?php


namespace App\Services\Order\V1_0\Domain\Queue;


use App\Services\Driver\V1_0\Domain\Repo\IDriverOnlineRepo;
use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\Order\V1_0\Jobs\PrepareFireBaseOrderDataJob;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use App\Services\User\V1_0\Infrastructure\Presenters\UserPresenter;
use Bobolink\Core\Bus\QueueUnitDispatcher;
use Bobolink\Core\Helpers\ArrayHelper;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Jenssegers\Mongodb\Collection;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Bus\UnitDispatcher;
use Taxi\Entity\DriverEntity;
use Taxi\Entity\OrderEntity;

class OrderPrepare implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;

    public $backoff = 10;
    public $tries = 100;
    public $searchRadius = [1000, 2000, 3000, 4000, 5000];

    private $orderEntity;


    public function __construct(OrderEntity $orderEntity)
    {
        $this->orderEntity = $orderEntity;
    }

    public function handle(IUserRepository $repository, IDriverRepo $driverRepo, IDriverOnlineRepo $driverOnlineRepo, IOrderRepo $orderRepo, IOrderOptionRepo $orderOptionRepo)
    {


        $order = $orderRepo->findWhere(['_id' => $this->orderEntity->getIdAttribute(), 'status' => 0]);

        if (empty($order)) {
            return;

//                die;
        }

        var_dump($this->orderEntity->getIdAttribute());

        $createdAt = $order->first()->getAttribute('created_at');

        $now = Carbon::now();
        if ($createdAt->diffInMinutes($now) >= 10) {
            $orderRepo->updateWhereNew(['status' => OrderEntity::STATUS_CANCEL], ['_id' => $this->orderEntity->getIdAttribute()]);
            return;
        }


        foreach ($this->searchRadius as $searchRadius) {

            $fromCoordinates = $this->orderEntity->getAttribute('from_coordinates');
            $driversOnline = $this->prepareDriversOnline($fromCoordinates, $searchRadius, $driverOnlineRepo);


            if (empty($driversOnline)) {
                var_dump(1);
                abort(100);
            }


//            if (!empty($driversOnline)) {

            $drivers = $this->getDrivers($driversOnline, $driverRepo);
            if (!empty($drivers)) {
                /**
                 * @var $driver DriverEntity
                 */
                foreach ($drivers as $driver) {
                    $processedDriver = Redis::get("ProcessedDriverOrder_" . $this->orderEntity->getIdAttribute() . "_" . $driver->getAttribute('id'));
                    if (!empty($processedDriver)) {
                        continue;
                    }

                    Redis::set("ProcessedDriverOrder_" . $this->orderEntity->getIdAttribute() . "_" . $driver->getAttribute('id'), 1);
                    Redis::EXPIRE("ProcessedDriverOrder_" . $this->orderEntity->getIdAttribute() . "_" . $driver->getAttribute('id'), 4 * 60);

                    $onlineDriver = ArrayHelper::findWhere($driversOnline, ['driver_id' => (int)$driver->getAttribute('id')]);


                    $driverCoordinates = $onlineDriver['location']['coordinates'];
                    $unitDispatcher = new QueueUnitDispatcher();
                    $fireBaseOrder = $unitDispatcher->run(PrepareFireBaseOrderDataJob::class, ['order' => $this->orderEntity, 'driverCoordinates' => $driverCoordinates]);

                    /**
                     * @var $db Database
                     */
                    $db = app('firebase.database');
//                        $auth = app('firebase.auth');
//                        $signInResult = $auth->signInAnonymously();

                    /**
                     * @var $ref Reference
                     */
                    $ref = $db->getReference('Drivers/' . $driver->getAttribute('id') . '/TempOrder/');
//                            try {
                    $currentDriverOrder = $ref->getValue();


                    if (empty($currentDriverOrder)) {
                        $ref->set($fireBaseOrder);
                        var_dump(2);
                        abort(100);

                    }

//                            } catch (DatabaseException $e) {
//                                abort(500. $e->)
//                            }
                    //  ->set($fireBaseOrder);
//                        var_dump($ref);
//                        abort(500);
                }
//
            }
            var_dump(3);
            abort(100);


//                var_dump($drivers);
            //  abort(500);
//            }
//            var_dump($drivers);
//            abort(500);
        }

//        var_dump($this->orderEntity);
        var_dump(4);
        abort(100);
    }

    private function prepareDriversOnline($fromCoordinates, $searchRadius, $driverOnlineRepo): array
    {
        /**
         * @var $driversOnline \Illuminate\Database\Eloquent\Collection
         */
        $driversOnline = $driverOnlineRepo->where('location', 'near', [
            '$geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $fromCoordinates['coordinates'][0], // longitude
                    $fromCoordinates['coordinates'][1], // latitude
                ],
            ],
            '$maxDistance' => $searchRadius,
        ])->get();
        return $driversOnline->toArray();
    }

    private function getDrivers(array $driversOnline, IDriverRepo $driverRepo)
    {
        $driverIds = ArrayHelper::getColumn($driversOnline, 'driver_id');
        return $driverRepo->orderBy('star', 'DESC')->findWhereIn('id', $driverIds);
    }


}
