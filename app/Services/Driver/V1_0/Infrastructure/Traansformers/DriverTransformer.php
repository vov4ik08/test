<?php


namespace App\Services\Driver\V1_0\Infrastructure\Traansformers;


use Hashids\Hashids;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use Taxi\Entity\DriverEntity;

class DriverTransformer extends TransformerAbstract
{
    public function transform(DriverEntity $model)
    {

        $driver = $model->toArray();
        $driver['avatar'] = Storage::disk('s3')->url('driver/avatar/no_avatar.png');

        if (!empty($driver['avatar_version'])) {
            $hashids = new Hashids();
            $driver['avatar'] = Storage::disk('s3')->url('driver/avatar/' . $hashids->encode($user['id']) . '/s1/avatar_' . $user['avatar_version'] . '.png');
        }

        if (!empty($driver['navigation'])) {
            $driver['navigation'] = json_decode($driver['navigation'], true);
        }

        return $driver;
    }
}
