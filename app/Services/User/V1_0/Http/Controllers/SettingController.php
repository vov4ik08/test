<?php


namespace App\Services\User\V1_0\Http\Controllers;


use App\Services\User\V1_0\Application\Features\SettingFeature;
use Lucid\Units\Controller;

class SettingController  extends Controller
{
    public function index()
    {
        return $this->serve(SettingFeature::class);
    }
}
