<?php

namespace App\Services\Order\V1_0\Jobs;

use Lucid\Units\Job;

class CreateUserOrderInFireBaseJob extends Job
{
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle()
    {

        $db = app('firebase.database');
        $ref = $db->getReference('UserOrders/' . $this->order['_id']);
        unset($this->order['snapshot']);
        $ref->set($this->order);


    }
}
