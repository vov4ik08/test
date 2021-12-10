<?php


namespace App\Services\Driver\V1_0\Infrastructure\Presenters;


use App\Services\Driver\V1_0\Infrastructure\Traansformers\DriverTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class DriverPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new DriverTransformer();
    }
}
