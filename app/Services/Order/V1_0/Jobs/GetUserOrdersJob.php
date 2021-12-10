<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class GetUserOrdersJob extends Job
{

    public function handle(IOrderRepo $orderRepo)
    {
        $userId = Auth::id();
        return $orderRepo->findWhere(['user_id' => $userId, ['status', '>', -1]]);

    }
}
