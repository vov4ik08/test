<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\User\V1_0\Infrastructure\Repo\UserRepository;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class UpdateUserAvatarJob extends Job
{
    public function handle(UserRepository $repository)
    {
        $user = Auth::user();
        $user->setAttribute('avatar_version', $user['avatar_version'] + 1);
        $user->save();
        $newUser = $repository->skipPresenter()->with('profile')->find($user->getAuthIdentifier());
        Auth::setUser($newUser);


        return $newUser->presenter();
    }
}
