<?php


namespace App\Services\Order\V1_0\Jobs;


use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Units\Job;

class AcceptOrderErrorJob extends Job
{
    public function handle()
    {
        /**
         * @var $db Database
         */
        $db = app('firebase.database');

        /**
         * @var $ref Reference
         */
        $ref = $db->getReference('Drivers/' . Auth::id() . '/Notification/');
        try {
            $notification = ['type' => 'error', 'msg' => 'Заказ не доступен'];
            $ref->push($notification);

        } catch (DatabaseException $e) {
            throw $e;
        }
    }

}
