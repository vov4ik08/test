<?php


namespace App\Services\Order\V1_0\Jobs;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Units\Job;

class CheckDriverHasOrder extends Job
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
        $ref = $db->getReference('Drivers/' . Auth::id() . '/CurrentOrder/');
        try {
            $currentDriverOrder = $ref->getValue();
            return empty($currentDriverOrder);

        } catch (DatabaseException $e) {
            throw $e;
        }

    }
}
