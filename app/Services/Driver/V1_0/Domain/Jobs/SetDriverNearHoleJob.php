<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Request\DriverNearHoleRequest;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Units\Job;

class SetDriverNearHoleJob extends Job
{
    public function handle(DriverNearHoleRequest $request)
    {
        /**
         * @var $db Database
         */
        $db = app('firebase.database');

        $res = $db->getReference('Drivers/' . Auth::id() . '/CurrentOrder')
            ->orderByChild('id')
            ->equalTo($request->get('order_id'));
        try {
            return $res->getReference()->update(['status' => 2])->getValue();

        } catch (DatabaseException $e) {
            throw $e;
        }
    }
}
