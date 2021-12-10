<?php


namespace App\Services\Driver\V1_0\Application\Providers;


use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    /**
     * Register the Auth service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
//        $this->app->register(EventServiceProvider::class);


//        View::addNamespace('user', realpath(__DIR__ . '/../../resources/views'));



//        $this->app['router']->aliasMiddleware('encapsulate-address', EncapsulateAddress::class);

//        $this->registerResources();
    }
}
