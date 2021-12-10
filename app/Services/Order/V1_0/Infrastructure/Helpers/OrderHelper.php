<?php


namespace App\Services\Order\V1_0\Infrastructure\Helpers;


use Illuminate\Support\Facades\Http;

class OrderHelper
{
    public static function buildDriverDistanceDuration($fromCoordinates, $toCoordinates): array
    {

        $response = Http::get("http://46.101.103.46:5000/route/v1/driving/" . $fromCoordinates[0] . "," . $fromCoordinates[1] . ";" . $toCoordinates[0] . "," . $toCoordinates[1] . "?steps=true");
        $distanceToDriver = 0.0;
        $durationToDriver = 0.0;
        if ($response->status() == 200) {
            $routes = json_decode($response->body(), true);
            $distanceToDriver = $routes['routes'][0]['distance'];
            $durationToDriver = $routes['routes'][0]["duration"];

        }
        return [
            'distance' => $distanceToDriver,
            'duration' => $durationToDriver

        ];
    }
}
