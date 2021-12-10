<?php


namespace App\Services\User\V1_0\Infrastructure\Transformers;


use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;
use Taxi\Entity\TaxiTypeEntity;

class TaxiTypeTransformer extends TransformerAbstract
{
    public function transform(TaxiTypeEntity $model): array
    {
        $type = $model->toArray();
        $type['icon'] = Storage::disk('s3')->url($type['icon']);
        return $type;
    }
}
