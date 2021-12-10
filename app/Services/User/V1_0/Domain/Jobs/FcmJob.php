<?php


namespace App\Services\User\V1_0\Domain\Jobs;


use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Lucid\Units\Job;

class FcmJob extends Job
{
    /**
     * @var array
     */
    private $hashText;

    public function __construct(array $hashText)
    {
        $this->hashText = $hashText;
    }

    public function handle()
    {
        $messaging = Firebase::messaging();

        foreach ($this->hashText as $token => $text) {
            $message = CloudMessage::withTarget("token", $token)
                ->withNotification(Notification::create($text['title'], $text['body']));
//                ->withData(['key' => 'value']);
            $messaging->send($message);

        }

    }
}
