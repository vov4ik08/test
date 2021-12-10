<?php


namespace App\Services\Order\V1_0\Infrastructure\Repo;


use App\Services\Order\V1_0\Domain\Repo\IOrderOptionRepo;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\OrderOptionEntity;

class OrderOptionRepo extends BaseRepository implements IOrderOptionRepo
{

    public function model()
    {
        return OrderOptionEntity::class;
    }
}
