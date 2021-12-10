<?php


namespace App\Services\Order\V1_0\Http\Controllers;


use App\Services\Driver\V1_0\Domain\Request\AcceptOrderRequest;
use App\Services\Order\V1_0\Application\Features\AcceptOrderFeature;
use App\Services\Order\V1_0\Application\Features\CancelBeforeFindDriverFeature;
use App\Services\Order\V1_0\Application\Features\CreateOrderFeature;
use App\Services\Order\V1_0\Application\Features\GetUserOrdersFeature;
use App\Services\Order\V1_0\Application\Features\OrderOptionFeature;
use App\Services\Order\V1_0\Domain\Request\CreateOrderRequest;
use Lucid\Units\Controller;

class OrderController extends Controller
{
    public function option()
    {
        return $this->serve(OrderOptionFeature::class);
    }

    public function create(CreateOrderRequest $createOrderRequest)
    {
        return $this->serve(CreateOrderFeature::class);

    }

    public function accept(AcceptOrderRequest  $acceptOrderRequest)
    {
        return $this->serve(AcceptOrderFeature::class);
    }

    public function getUserOrders()
    {
        return $this->serve(GetUserOrdersFeature::class);
    }

    public function cancelBeforeFindDriver()
    {
        return $this->serve(CancelBeforeFindDriverFeature::class);

    }


}
