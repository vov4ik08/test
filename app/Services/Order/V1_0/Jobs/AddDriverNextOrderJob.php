<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Driver\V1_0\Domain\Request\AcceptOrderRequest;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Units\Job;

class AddDriverNextOrderJob extends Job
{
    public function handle(AcceptOrderRequest $request)
    {
        /**
         * @var $db Database
         */
        $db = app('firebase.database');

        /**
         * @var $ref Reference
         */
        $ref = $db->getReference('Drivers/' . Auth::id() . '/OrderQueue');
        try {
            $ref->push($request->get('order_id'));

        } catch (DatabaseException $e) {
            throw $e;
        }
    }
}
