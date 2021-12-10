<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Request\LoginRequest;
use App\Services\Driver\V1_0\Domain\Repo\IDriverRepo;
use App\Services\Driver\V1_0\Infrastructure\Presenters\DriverPresenter;
use Illuminate\Support\Facades\Hash;
use Lucid\Units\Job;

class LoginJob extends Job
{
    public function handle(LoginRequest $request, IDriverRepo $driverRepository)
    {
        $driver = $driverRepository->skipPresenter()->with(['profile','cars'])->findWhere(['email' => $request->post('email')]);
        $driver = $driver->first();
        if ($driver && Hash::check($request->post('password'), $driver->getAttribute('password'))) {
            $token = $driver->createToken($driver->email)->accessToken;

            $driver = $driver->setPresenter(new DriverPresenter());
            $driver = $driver->presenter();
            $driver = $driver['data'];
            $driver['token'] = $token;
            return $driver;

        }
        abort(404);
    }
}
