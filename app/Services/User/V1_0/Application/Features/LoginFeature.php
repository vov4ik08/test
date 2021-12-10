<?php


namespace App\Services\User\V1_0\Application\Features;



use App\Services\User\V1_0\Domain\Events\GenerateUserLoginCodeEvent;
use App\Services\User\V1_0\Domain\Jobs\AddUserStarJob;
use App\Services\User\V1_0\Domain\Jobs\CreateUserJob;
use App\Services\User\V1_0\Domain\Jobs\LoginJob;
use Lucid\Units\Feature;
use function event;

class LoginFeature extends Feature
{
    public function handle()
    {
        $user = $this->run(LoginJob::class);
        $isNew = false;

        if (empty($user)) {
            $user = $this->run(CreateUserJob::class);
            $this->run(AddUserStarJob::class, ['user_id' => $user->getAttribute('id'), 'stars' => 5.0]);
            $isNew = true;
        }
        $user = $user->presenter();
        $user['data']['is_new'] = $isNew;

        event(new GenerateUserLoginCodeEvent($user['data']));

        return $user;


    }
}
