<?php


namespace App\Services\User\V1_0\Infrastructure\Transformers;



use Hashids\Hashids;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use Taxi\Entity\UserEntity;

class UserTransformer extends TransformerAbstract
{
    public function transform(UserEntity $model)
    {
//        $model->setAttribute('avatar', config('automoor.cloud_front_url') . "/avatars/no_avatar.png");
//
//        if (!empty($model->getAttribute('has_avatar'))) {
//            $model->setAttribute('avatar', config('automoor.cloud_front_url') . "/avatars/" . $model['id'] . "/s0/" . 'avatar_' . $model['avatar_version'] . '.png');
//        }
        $user = $model->toArray();
        $user['avatar'] = Storage::disk('s3')->url('user/avatar/no_avatar.png');

        if (!empty($user['avatar_version'])) {
            $hashids = new Hashids();
            $user['avatar'] = Storage::disk('s3')->url('user/avatar/' . $hashids->encode($user['id']) . '/s1/avatar_' . $user['avatar_version'] . '.png');
        }

        return $user;
    }
}
