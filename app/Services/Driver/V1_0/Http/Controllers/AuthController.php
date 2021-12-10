<?php


namespace App\Services\Driver\V1_0\Http\Controllers;


use App\Services\Driver\V1_0\Application\Features\GetDriverFeature;
use App\Services\Driver\V1_0\Application\Features\LoginFeature;
use App\Services\Driver\V1_0\Domain\Request\LoginRequest;
use Lucid\Units\Controller;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $this->serve(LoginFeature::class);

    }

    public function getDriver()
    {
        return $this->serve(GetDriverFeature::class);

    }
}
