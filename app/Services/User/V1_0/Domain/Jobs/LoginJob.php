<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\User\V1_0\Domain\Requests\PhoneRequest;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use Lucid\Units\Job;

class LoginJob extends Job
{
    public function handle(PhoneRequest $request, IUserRepository $userRepository)
    {
        $user = $userRepository->skipPresenter()->with(['profile'])->findWhere(
            ['phone' => $request->post('phone')]
        )->first();
//        if ($user) {
////            if (Hash::check($request->get('password'), $user->getAttribute('password_hash'))) {
////                if (!$request->post('remember')) {
//            Passport::personalAccessTokensExpireIn(now()->addHours(12));
////                }
//            $token = $user->createToken($user->phone)->accessToken;
//
//            $user = $user->presenter();
//            $user = $user['data'];
//
//            $user['token'] = $token;
//            return $user;
////            }
//        }

        return $user;
    }
}
