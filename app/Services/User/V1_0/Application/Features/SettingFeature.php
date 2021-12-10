<?php


namespace App\Services\User\V1_0\Application\Features;


use App\Services\Order\V1_0\Jobs\OrderOptionJob;
use App\Services\User\V1_0\Domain\Jobs\LoadTaxiTypeJob;
use Illuminate\Support\Facades\Cache;
use Lucid\Units\Feature;
use function now;

class SettingFeature extends Feature
{
    public function handle(): array
    {
        Cache::flush();
        $settings = Cache::remember('settings', now()->addMinutes(60), function () {
//            $versionAPI = config('app.api_version');
//            $orderOption = Http::get("http://api.taxi.loc/V$versionAPI/order/option");
            $orderOption = $this->run(OrderOptionJob::class);
            $taxiTypes = $this->run(LoadTaxiTypeJob::class);
            $settings['taxi_types'] = $taxiTypes['data'];
            $settings['delivery_price'] = "50";
            $settings['kilometer_price'] = "5.5";
            $settings["order_option"] = $orderOption;
            return $settings;

        });




        return $settings;
    }
}
