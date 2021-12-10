<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\User\V1_0\Domain\Repo\IUserStarRepository;
use Lucid\Units\Job;

class AddUserStarJob extends Job
{
    public $userId;
    public $stars;

    public function __construct($user_id, $stars)
    {
        $this->userId = $user_id;
        $this->stars = $stars;
    }

    public function handle(IUserStarRepository $repository)
    {
        return $repository->skipPresenter()->create(['user_id' => $this->userId, 'stars' => $this->stars]);
    }
}
