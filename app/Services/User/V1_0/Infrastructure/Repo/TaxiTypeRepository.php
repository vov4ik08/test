<?php


namespace App\Services\User\V1_0\Infrastructure\Repo;


use App\Services\User\V1_0\Domain\Repo\ITaxiTypeRepository;
use App\Services\User\V1_0\Infrastructure\Presenters\TaxiTypePresenter;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\TaxiTypeEntity;

class TaxiTypeRepository extends BaseRepository implements ITaxiTypeRepository
{

    public function model(): string
    {
        return TaxiTypeEntity::class;
    }

    public function presenter(): string
    {
        return TaxiTypePresenter::class;
    }
}
