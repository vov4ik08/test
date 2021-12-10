<?php


namespace App\Services\User\V1_0\Application\Providers;


use App\Services\User\V1_0\Domain\Repo\ITaxiTypeRepository;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use App\Services\User\V1_0\Domain\Repo\IUserStarRepository;
use App\Services\User\V1_0\Infrastructure\Repo\TaxiTypeRepository;
use App\Services\User\V1_0\Infrastructure\Repo\UserRepository;
use App\Services\User\V1_0\Infrastructure\Repo\UserStarRepository;
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
        $this->app->bind(IUserRepository::class, UserRepository::class);
//        $this->app->bind(IUserLocationSearchRepository::class, UserLocationSearchRepository::class);
        $this->app->bind(IUserStarRepository::class, UserStarRepository::class);
        $this->app->bind(ITaxiTypeRepository::class, TaxiTypeRepository::class);


    }
}
