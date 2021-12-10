<?php


namespace App\Services\Driver\V1_0\Http\Controllers;


use App\Services\Driver\V1_0\Domain\Request\DirectionRequest;
use Lucid\Units\Controller;

class MapController extends Controller
{
    public function direction(DirectionRequest $request)
    {
        $params = ['origin' => $request->get('origin'), 'destination' => $request->get('destination'), 'mode' => 'driving'];
        $response = \GoogleMaps::load('directions')
            ->setParam($params)
            ->get();

        return json_decode($response, true);
    }
}
