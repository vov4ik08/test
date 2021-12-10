<?php


namespace App\Services\User\V1_0\Infrastructure\Repo;


use App\Services\User\V1_0\Domain\Repo\IUserRepository;
use App\Services\User\V1_0\Infrastructure\Presenters\UserPresenter;
use Bobolink\Core\Infrastructure\Repository\BaseRepository;
use Illuminate\Http\Request;
use Taxi\Entity\UserEntity;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return UserEntity::class;
    }

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function presenter(): string
    {
        return UserPresenter::class;
    }

    public function updateProfile(Request $request, $user)
    {
        $params = [
            'first_name' => $request->input(['first_name']),
            'last_name' => $request->input(['last_name']),
            'date_of_birth' => $request->input(['date_of_birth']),
            'user_id' => $user->getAttribute('id')


        ];
        if(empty($user->profile)){
            return $user->profile()->create($params);
        }

        return $user->profile()->update($params);
    }
}
