<?php


namespace App\Services\Driver\V1_0\Domain\Jobs;


use App\Services\Driver\V1_0\Domain\Request\SetDefaultCarRequest;
use App\Services\Driver\V1_0\Infrastructure\Repo\DriverCarRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lucid\Units\Job;

class SetDefaultCarJob extends Job
{
    public function handle(SetDefaultCarRequest $request, DriverCarRepo $driverCarRepo)
    {
        $a = $request->get('car_id');
        DB::beginTransaction();
        $res = $driverCarRepo->updateWhereNew(['is_used' => 0], ['driver_id' => Auth::id()]);
        if ($res) {
            $res = $driverCarRepo->updateWhereNew(['is_used' => 1], ['driver_id' => Auth::id(), 'id' => $request->get('car_id')]);
            if ($res) {
                DB::commit();
                return true;
            }
        }
        DB::rollBack();
        return false;
    }
}
