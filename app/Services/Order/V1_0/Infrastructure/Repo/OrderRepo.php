<?php


namespace App\Services\Order\V1_0\Infrastructure\Repo;


use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\OrderEntity;

class OrderRepo extends BaseRepository implements IOrderRepo
{

    public function model()
    {
        return  OrderEntity::class;
    }
}
