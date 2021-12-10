<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use App\Services\User\V1_0\Domain\Requests\PhoneRequest;
use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use Lucid\Units\Job;

class CreateUserJob extends Job
{
    public function handle(PhoneRequest $request, IUserRepository $userRepository)
    {
        return $userRepository->skipPresenter()->create(['phone' => $request->post('phone')]);
    }
}
