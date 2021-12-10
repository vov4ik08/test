<?php


namespace App\Services\User\V1_0\Infrastructure\Repo;


use App\Services\User\V1_0\Domain\Repo\IUserStarRepository;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Taxi\Entity\UserStarEntity;

class UserStarRepository extends BaseRepository implements IUserStarRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return UserStarEntity::class;
    }
}
