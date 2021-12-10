<?php


namespace App\Services\User\V1_0\Domain\Jobs;

use App\Services\User\V1_0\Domain\Requests\ValidatePinRequest;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use Illuminate\Support\Facades\Cache;
use Lucid\Units\Job;

class ValidatePinJob extends Job
{
    public function handle(ValidatePinRequest $request, IUserRepository $userRepository)
    {
        $key = 'user_' . $request->post('phone');
        $cacheData = Cache::tags([md5($key)])->get(md5($key), null);
        if (!empty($cacheData) && $cacheData['code'] == $request->post('pin')) {
            $user = $userRepository->skipPresenter()->find($cacheData['user']['id']);

            $updatePhoneKey = 'user_' . $user->getAttribute('id') . '_new_phone' . $user->getAttribute('phone');
            $newPhone = Cache::get(md5($updatePhoneKey));
            if (!empty($newPhone)) {
                $user->setAttribute('phone', $newPhone);
                $user->setAttribute('phone_updated_at', now());

                $user->save();
                Cache::forget(md5($updatePhoneKey));

            }


            $token = $user->createToken($user->phone)->accessToken;
            $user = $user->presenter();
            $user = $user['data'];
            $user['is_new'] = $cacheData['user']['is_new'];
            $user['token'] = $token;
//            $result['data'] = $user;
            Cache::tags([md5($key)])->flush();


            return $user;

        }


        abort(404);
    }
}
