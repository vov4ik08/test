<?php


namespace App\Services\User\V1_0\Infrastructure\Presenters;


use App\Services\User\V1_0\Infrastructure\Transformers\TaxiTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class TaxiTypePresenter extends FractalPresenter
{

    public function getTransformer(): TaxiTypeTransformer
    {
        return new TaxiTypeTransformer();
    }
}
