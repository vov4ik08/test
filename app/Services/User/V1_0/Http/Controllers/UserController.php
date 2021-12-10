<?php


namespace App\Services\User\V1_0\Http\Controllers;


use App\Services\User\V1_0\Application\Features\GetCurrentUserFeature;
use App\Services\User\V1_0\Application\Features\UpdateAvatarFeature;
use App\Services\User\V1_0\Application\Features\UpdateProfileFeature;
use App\Services\User\V1_0\Domain\Requests\ProfileRequest;
use App\Services\User\V1_0\Domain\Requests\UpdateAvatarRequest;
use Lucid\Units\Controller;

class UserController extends Controller
{
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        return $this->serve(UpdateAvatarFeature::class);
    }


    public function updateProfile(ProfileRequest $request)
    {
        return $this->serve(UpdateProfileFeature::class);
    }
}
