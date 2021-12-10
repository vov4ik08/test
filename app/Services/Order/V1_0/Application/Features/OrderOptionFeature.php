<?php


namespace App\Services\Order\V1_0\Application\Features;


use App\Services\Order\V1_0\Jobs\OrderOptionJob;
use Illuminate\Support\Facades\Cache;
use Lucid\Units\Feature;
use function now;

class OrderOptionFeature extends Feature
{
    public function handle()
    {

        $value = Cache::remember('order_type', now()->addMinutes(60), function () {
            return $this->run(OrderOptionJob::class);
        });

        return $value;
    }
}
