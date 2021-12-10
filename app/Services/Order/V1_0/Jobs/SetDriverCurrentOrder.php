<?php


namespace App\Services\Order\V1_0\Jobs;


use App\Services\Driver\V1_0\Domain\Request\AcceptOrderRequest;
use App\Services\Order\V1_0\Domain\Repo\IOrderRepo;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Exception\DatabaseException;
use Lucid\Units\Job;

class SetDriverCurrentOrder extends Job
{
    /**
     * @var array
     */
    private $fireBaseOrderData;

    public function __construct(array $fireBaseOrderData)
    {
        $this->fireBaseOrderData = $fireBaseOrderData;
    }

    public function handle(IOrderRepo $orderRepo, AcceptOrderRequest $request)
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
            return $ref->set($this->fireBaseOrderData);
        } catch (DatabaseException $e) {
            throw $e;
        }


    }
}
