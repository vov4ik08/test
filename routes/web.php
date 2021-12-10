<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Database\Reference;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\App\Services\Order\V1_0\Domain\Repo\IOrderRepo $orderRepo) {

    $db = app('firebase.database');
    /**
     * @var $ref Reference
     */
    $ref = $db->getReference('UserOrders/' . '61a5e2b81435150797672192');
    $ref->update(['status' => -1]);
    $ref->remove();


//    $messaging = Firebase::messaging();
//    for ($i = 0; $i <= 5; $i++) {
//        $message = CloudMessage::withTarget("token", "eBpPnwKxSqaOS4lLcoCy0h:APA91bGeFtaARldJ4xfJz7y2z_fdJtV84HfF9iHqre9qcAKnCJZW9jTXghojVK4UEGy47AIwwl_VBnI10yizTZKfmy7hUy9srE-kz81IzKFilvsDts571o6KKTlTik7v4N5aJafK7del")
//            ->withNotification(Notification::create('Title', 'Body'))
//            ->withData(['key' => 'value']);
//        $messaging->send($message);
//    }
//    Redis::set("ProcessedDriverOrder_" . 123_13,1 );
//    Redis::EXPIRE("ProcessedDriverOrder_" . 123_13, 60);
//    $processedDrivers = Redis::get("ProcessedDriverOrder_" . 123_13);
//    var_dump($processedDrivers);die;

//    $order = $orderRepo->findWhere(['_id' => '619cd382e0b69e096e0d2a22', 'status' => 0]);
//    $now = Carbon::now();
//    /**
//     * @var $createdAt Illuminate\Support\Carbon
//     */
//    $createdAt = $order->first()->getAttribute('created_at');
//
//
////    $createdAt->diff($now);
////    Carbon::parse($order)
//    var_dump($createdAt->diffInMinutes($now));
//    die;
//    return view('welcome');
});
