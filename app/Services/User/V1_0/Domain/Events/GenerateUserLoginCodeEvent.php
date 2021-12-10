<?php


namespace App\Services\User\V1_0\Domain\Events;


use Illuminate\Queue\SerializesModels;

class GenerateUserLoginCodeEvent
{
    use SerializesModels;


    public $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }
}
