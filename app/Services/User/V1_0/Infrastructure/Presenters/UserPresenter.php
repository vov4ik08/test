<?php


namespace App\Services\User\V1_0\Infrastructure\Presenters;


use App\Services\User\V1_0\Infrastructure\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{
    /**
     * @return UserTransformer|\League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
