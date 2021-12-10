<?php


namespace App\Services\Driver\V1_0\Application\Providers;


use App\Services\Driver\V1_0\Domain\Repo\IDriverCarRepo;
use App\Services\Driver\V1_0\Domain\Repo\IDriverOnlineRepo;
use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use App\Services\Driver\V1_0\Infrastructure\Repo\DriverCarRepo;
use App\Services\Driver\V1_0\Infrastructure\Repo\DriverOnlineRepo;
use App\Services\Driver\V1_0\Infrastructure\Repo\DriverRepo;
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
        $this->app->bind(IDriverRepo::class, DriverRepo::class);
        $this->app->bind(IDriverCarRepo::class, DriverCarRepo::class);
        $this->app->bind(IDriverOnlineRepo::class, DriverOnlineRepo::class);

    }
}
