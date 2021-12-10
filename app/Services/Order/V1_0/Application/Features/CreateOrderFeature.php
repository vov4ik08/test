<?php


namespace App\Services\Order\V1_0\Application\Features;


use App\Services\Order\V1_0\Domain\Queue\OrderKiller;
use App\Services\Order\V1_0\Domain\Queue\OrderPrepare;
use App\Services\Order\V1_0\Domain\Request\CreateOrderRequest;
use App\Services\Order\V1_0\Jobs\CreateOrderJob;
use App\Services\Order\V1_0\Jobs\CreateUserOrderInFireBaseJob;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Feature;
use Taxi\Entity\OrderEntity;
use function decode_polyline;
use function last;
use function now;

class CreateOrderFeature extends Feature
{
    public function handle(CreateOrderRequest $createOrderRequest)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $from = json_decode($createOrderRequest->post('from'), true);
        $fromCoordinates = ['type' => 'Point', 'coordinates' => [!empty($from['realLatLng']) ? $from['realLatLng'][1] : $from['latLng'][1], !empty($from['realLatLng']) ? $from['realLatLng'][0] : $from['latLng'][0]]];

        $to = \Symfony\Component\Yaml\Yaml::parse($createOrderRequest->post('to'));
        $lastTo = last($to);

        $toCoordinates = ['type' => 'Point', 'coordinates' => [!empty($lastTo['realLatLng']) ? $lastTo['realLatLng'][1] : $lastTo['latLng'][1], !empty($lastTo['realLatLng']) ? $lastTo['realLatLng'][0] : $lastTo['latLng'][0]]];

        $price = $createOrderRequest->post('price');

        $polylineInformation = json_decode($createOrderRequest->post('polyline_information'), true);
        $polylinePoints = decode_polyline($polylineInformation['routes'][0]['overview_polyline']['points']);
        $fullRoutes = [];
        foreach ($polylinePoints as $point) {
            $fullRoutes[] = [$point[1], $point[0]];
        }

        $fullRoutes = ['type' => 'LineString', 'coordinates' => $fullRoutes];


        $comment = $createOrderRequest->post('comment');
        $selectedOptionItems = null;
        if (!empty($createOrderRequest->post('order_option'))) {
            $selectedOptionItems = \Symfony\Component\Yaml\Yaml::parse($createOrderRequest->post('order_option'));

        }
        $textOptionsControllers = null;
        if (!empty($createOrderRequest->post('order_option_text'))) {
            $textOptionsControllers = \Symfony\Component\Yaml\Yaml::parse($createOrderRequest->post('order_option_text'));
        }
        $platform = $createOrderRequest->post('platform');
        $userFireBaseToken = $createOrderRequest->post('user_fire_base_token');

        $order = $this->run(CreateOrderJob::class, ['params' => [
            'user_id' => $userId,
            'full_route' => $fullRoutes,
            'polyline_information' => $polylineInformation,
            'from' => $from,
            'to' => $to,
            'from_coordinates' => $fromCoordinates,
            'to_coordinates' => $toCoordinates,
            'price' => doubleval($price),
            'status' => OrderEntity::STATUS_NEW,
            'platform' => $platform,
            'user_fire_base_token' => $userFireBaseToken,
            'order_option' => $selectedOptionItems,
            'order_option_text' => $textOptionsControllers,
            'comment' => $comment,
            'snapshot' => $createOrderRequest->post('snapshot')
        ]
        ]);

        $this->run(CreateUserOrderInFireBaseJob::class, ['order' => $order]);
        OrderKiller::dispatch($order)->onQueue("order_killer")->delay(now()->addMinutes(10));
        OrderPrepare::dispatch($order)->onQueue('order_prepare');


        return $order;


    }
}
