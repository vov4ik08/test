<?php


namespace App\Services\Driver\V1_0\Infrastructure\Repo;


use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\DriverEntity;

class DriverRepo extends BaseRepository implements IDriverRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DriverEntity::class;
    }
}
