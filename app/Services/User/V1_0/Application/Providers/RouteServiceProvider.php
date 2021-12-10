<?php


namespace App\Services\User\V1_0\Application\Providers;
use Bobolink\Core\Application\Providers\AbstractRouteServiceProvider;
use Illuminate\Routing\Router;


class RouteServiceProvider extends AbstractRouteServiceProvider
{

    public function map(Router $router)
    {
        $namespace = 'App\Services\User\V1_0\Http\Controllers';
        $pathApi = __DIR__.'/../../routes/user.php';

        $this->loadRoutesFiles($router, $namespace, $pathApi);
    }
//
//    protected function mapApiRoutes($router, $namespace, $path, $prefix = '')
//    {
//        $router->group([
//            'middleware' => 'api',
//            'namespace' => $namespace,
//            'prefix' => $prefix // to allow the delete or change of api prefix
//        ], function ($router) use ($path) {
//            require $path;
//        });
//    }
}
