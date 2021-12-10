<?php


namespace App\Services\User\V1_0\Application\Providers;


use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
        $this->app->register(EventServiceProvider::class);
//        $this->app['router']->aliasMiddleware('is-user-active', IsUserActive::class);


//        View::addNamespace('user', realpath(__DIR__ . '/../../resources/views'));



//        $this->app['router']->aliasMiddleware('encapsulate-address', EncapsulateAddress::class);

//        $this->registerResources();
    }
}
