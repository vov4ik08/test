<?php


namespace App\Services\User\V1_0\Domain\Repo;


use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

interface IUserRepository extends RepositoryInterface
{
    public function updateProfile(Request $request, $user);
}
