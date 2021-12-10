<?php

namespace App\Services\Order\V1_0\Application\Features;

use App\Services\Order\V1_0\Domain\Request\CancelOrderRequest;
use App\Services\Order\V1_0\Jobs\CancelByUserOrderRDJob;
use App\Services\Order\V1_0\Jobs\CancelOrderMongoBeforeFindDriverJob;
use Lucid\Units\Feature;
use function abort;

class CancelBeforeFindDriverFeature extends Feature
{
    public function handle(CancelOrderRequest $request)
    {
        $res = $this->run(CancelOrderMongoBeforeFindDriverJob::class);
        if($res){
            $this->run(CancelByUserOrderRDJob::class);
            return true;
        }
        abort(406);
    }
}
