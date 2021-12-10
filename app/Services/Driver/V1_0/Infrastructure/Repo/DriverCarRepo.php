<?php


namespace App\Services\Driver\V1_0\Infrastructure\Repo;


use App\Services\Driver\V1_0\Domain\Repo\IDriverCarRepo;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\DriverCarEntity;

class DriverCarRepo extends BaseRepository implements IDriverCarRepo
{
    public function model()
    {
        return DriverCarEntity::class;
    }
}
