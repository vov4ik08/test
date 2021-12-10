<?php


namespace App\Services\Order\V1_0\Application\Providers;


use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use App\Services\Order\V1_0\Infrastructure\Repo\OrderOptionRepo;
use App\Services\Order\V1_0\Infrastructure\Repo\OrderRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IOrderOptionRepo::class, OrderOptionRepo::class);
        $this->app->bind(IOrderRepo::class, OrderRepo::class);


    }
}
