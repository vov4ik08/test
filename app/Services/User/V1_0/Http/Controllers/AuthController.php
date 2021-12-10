<?php


namespace App\Services\User\V1_0\Http\Controllers;


use App\Services\User\V1_0\Application\Features\LoginFeature;
use App\Services\User\V1_0\Application\Features\ValidatePinFeature;
use App\Services\User\V1_0\Domain\Requests\ValidatePinRequest;
use Lucid\Units\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return $this->serve(LoginFeature::class);
    }

    public function validatePin(ValidatePinRequest $request)
    {
        return $this->serve(ValidatePinFeature::class);
    }

}
