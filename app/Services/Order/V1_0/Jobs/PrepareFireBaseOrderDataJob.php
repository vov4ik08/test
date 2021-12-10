<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\Order\V1_0\Infrastructure\Helpers\OrderHelper;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use App\Services\User\V1_0\Infrastructure\Presenters\UserPresenter;
use Bobolink\Core\Helpers\ArrayHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Lucid\Units\Job;
use Taxi\Entity\OrderEntity;

class PrepareFireBaseOrderDataJob extends Job
{
    /**
     * @var OrderEntity
     */
    private $order;
    private $driverCoordinates;

    public function __construct(OrderEntity $order, $driverCoordinates = null)
    {
        $this->order = $order;
        $this->driverCoordinates = $driverCoordinates;
    }

    public function handle(IUserRepository $userRepository, IOrderOptionRepo $orderOptionRepo)
    {
//        var_dump($this->driverCoordinates);abort(500);
        $polylineInformation = $this->order->getAttribute('polyline_information');
        $distance = $polylineInformation['routes'][0]['legs'][0]['distance']['value'];
        $duration = $polylineInformation['routes'][0]['legs'][0]['duration']['value'];
        $from = $this->order->getAttribute('from');
        $to = $this->order->getAttribute('to');
        $price = $this->order->getAttribute('price');

        $orderOption = $this->order->getAttribute('order_option');
        $fromCoordinates = $this->order->getAttribute('from_coordinates');
        $fromCoordinates = $fromCoordinates['coordinates'];

        $orderOption = $this->buildOrderOption($orderOption, $orderOptionRepo);

        $user = $userRepository
            ->with('profile')
            ->setPresenter(UserPresenter::class)
            ->find($this->order->getAttribute('user_id'));

        $toDriverDistanceDuration = null;

        if ($this->driverCoordinates != null) {
            $toDriverDistanceDuration = OrderHelper::buildDriverDistanceDuration($fromCoordinates, $this->driverCoordinates);
        }


        return [
            'id' => $this->order->getIdAttribute(),
            'distance' => $distance,
            'duration' => $duration,
            'from' => $from,
            'to' => $to,
            'order_option' => $orderOption,
            'distance_to_driver' => $toDriverDistanceDuration != null ? $toDriverDistanceDuration['distance'] : null,
            'duration_to_driver' => $toDriverDistanceDuration != null ? $toDriverDistanceDuration['duration'] : null,
            'status' => 0,
            'user' => $user['data'],
            'price' => $price

        ];

    }


    private function buildOrderOption($orderOption, IOrderOptionRepo $orderOptionRepo)
    {
        $result = $orderOptionRepo->findWhereIn('id', $orderOption);
        return $result->toArray();
    }
}
