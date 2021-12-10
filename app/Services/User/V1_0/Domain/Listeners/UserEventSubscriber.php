<?php


namespace App\Services\User\V1_0\Domain\Listeners;


use App\Services\User\V1_0\Domain\Events\GenerateUserLoginCodeEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Taxi\Entity\UserEntity;

class UserEventSubscriber
{
    const RESENT_TIMEOUT = 120;

    public function onUserEmailConfirmGenerate($event)
    {
//        /** @var UserEntity $user */
//        $user = $event->user;
//        $user->notify(new UpdateEmailNotification());
    }

    public function onUserLoginCodeGenerate($event)
    {
        /** @var UserEntity $user */

        $user = $event->user;
        $key = 'user_' . $user['phone'];
        $timeoutKey = $key . "_timeout";
        $data = Cache::tags([md5($key)])->get(md5($key));

        $code = rand(1000, 9999);

        $timeout = Cache::tags([md5($key)])->get(md5($timeoutKey));
        if (empty($data)) {
            $data['code'] = $code;
            $data['user'] = $user;
            Cache::tags([md5($key)])->put(md5($key), $data, now()->addMinutes(30));

        }
        if (empty($timeout) || $timeout->diffInSeconds(now()) >= self::RESENT_TIMEOUT) {
//            Notification::send($user, new LoginCode($data['code']));




            Cache::tags([md5($key)])->put(md5($timeoutKey), now(), now()->addMinutes(30));

        }
        Mail::raw($data['code'], function ($message) {
            $message->to('vov4ik08@gmail.com');
            $message->from('support@api.book-store.gq');

        });

        return $data;

    }


    public function subscribe($events)
    {
        $events->listen(
            GenerateUserLoginCodeEvent::class,
            self::class . '@onUserLoginCodeGenerate'
        );
//        $events->listen(
//            GenerateUserEmailConfirmEvent::class,
//            self::class . '@onUserEmailConfirmGenerate'
//        );


    }
}
