<?php


namespace App\Services\Order\V1_0\Application\Providers;


use Bobolink\Core\Application\Providers\AbstractRouteServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends AbstractRouteServiceProvider
{

    public function map(Router $router)
    {
        $namespace = 'App\Services\Order\V1_0\Http\Controllers';
        $pathApi = __DIR__.'/../../routes/order.php';

        $this->loadRoutesFiles($router, $namespace, $pathApi);
    }
}
