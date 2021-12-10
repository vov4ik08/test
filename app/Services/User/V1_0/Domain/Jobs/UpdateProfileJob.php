<?php

namespace App\Services\User\V1_0\Domain\Jobs;

use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use App\Services\User\V1_0\Domain\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class UpdateProfileJob  extends Job
{
    public function handle(ProfileRequest $request, IUserRepository $userRepository)
    {
        $user = Auth::user();
        $user = $userRepository->skipPresenter()->with('profile')->find($user->getAuthIdentifier());

        $userRepository->updateProfile($request, $user);

        if ($request->input(['email']) != $user->getAttribute('email')) {
            $user->setAttribute('email', $request->input(['email']));
            $hash = md5(now() . $user->getAttribute('id') . $request->input(['email']));
            $user->setAttribute('email_verified_token', $hash);
            $user->setAttribute('email_verified_at', null);
            $user->save();
          //  $user->notify(new UpdateEmailNotification());
        }

        $newUser = $userRepository->skipPresenter()->with('profile')->find($user->getAuthIdentifier());
        Auth::setUser($newUser);
        $user = Auth::user();

        return $user->presenter();
    }
}
