<?php


namespace App\Services\Driver\V1_0\Infrastructure\Repo;


use App\Services\Driver\V1_0\Domain\Repo\IDriverOnlineRepo;
use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\DriverEntity;
use Taxi\Entity\DriverOnlineEntity;

class DriverOnlineRepo extends BaseRepository implements IDriverOnlineRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return DriverOnlineEntity::class;
    }
}
