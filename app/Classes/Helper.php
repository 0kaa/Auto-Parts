<?php

use App\Models\MultiCustomOrder;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderStatus;
use App\Models\TapPayment;
use App\Services\Notify;

/*
    |--------------------------------------------------------------------------
    | Detect Active Route Function
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */

function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() === $route) return $output;
}

function getSetting($key)
{
    return \App\Models\Setting::where('key', $key)->first();
}

function getSettings($keys)
{
    return \App\Models\Setting::whereIn('key', $keys)->get();
}




/*
    |--------------------------------------------------------------------------
    | Detect Active Routes Function
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
function areActiveRoutes(array $routes, $output = "active open-sub-menu")
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() === $route) return $output;
    }
}

function sendEmail($title, $message, $to)
{

    Mail::to($to)->send(new \App\Mail\Kuco($title, $message));
}

function send_activation_code($msg, $numbers)
{
    // $client = new \GuzzleHttp\Client();
    // $url = "http://api.yamamah.com/SendSMSV2?Username=966595070182&Password=Jq5NE7n^3u9X&Tagname=muhtarf&RecepientNumber=$numbers&Message=$msg&SendDateTime=0&EnableDR=true&SentMessageID=true";

    // $request = $client->get($url, [
    //     'form_params' => [
    //         '_token' => csrf_field()
    //     ]
    // ]);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $fields = <<<EOT
{
  "userName": "zz-899",
  "numbers": $numbers,
  "userSender": "Ketagheaher",
  "apiKey": "d051f1906374993d2bb2f23672e5ce8d",
  "msg": "رمز التحقق: $msg"
}
EOT;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
}





function RedirectOrderToAnotherUser($seller_id, $rejected, $customOrder)
{
    $seller = \App\Models\User::where('id', $seller_id)->first();

    $user_same = \App\Models\User::whereNotIn('id', $rejected->toArray())
        ->where('id', '!=', $seller_id)
        ->where('city_id', $seller->city_id)
        ->where('is_company_facility_agent', $seller->is_company_facility_agent)
        ->where('is_company_facility_authorized_distributor', $seller->is_company_facility_authorized_distributor)
        ->where('activity_type_id', $seller->activity_type_id)
        ->where('region_id', $seller->region_id)
        ->whereRelation('roles', 'name', 'owner_store')
        ->limit(5)->get();

    $order_status_not_found = OrderStatus::where('slug', 'not_found')->first();

    if ($user_same->isEmpty()) {
        $customOrder->update(['order_status_id' => $order_status_not_found->id, 'seller_id' => null]);
        $notification = Notification::create([
            'user_id'       => $customOrder->user_id,
            'type'          => 'custom_order',
            'model_id'      => $customOrder->id,
            'message_en'    => 'Your order has been rejected from all sellers',
            'message_ar'    => 'تم رفض طلبك من كل البائعين',
        ]);

        Notify::NotifyMob($notification->message_ar, $notification->message_en, $customOrder->user_id, null, $data = null);
        return false;
    }

    $order_status_pending = OrderStatus::where('slug', 'pending')->first();

    foreach ($user_same as $user) {
        \App\Models\MultiCustomOrder::create([
            'seller_id' => $user->id,
            'custom_order_id' => $customOrder->id,
            'order_status_id' => $order_status_pending->id,
        ]);
    }
}


function generate_order_payment_url($order, $user)
{
    $price = $order->payment_id == 1 ? $order->total_amount - ($order->total_amount * 80 / 100) : $order->total_amount;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>
        "{
                    \"amount\":$price,
                    \"currency\":\"SAR\",
                    \"description\":\"description\",
                    \"reference\":{\"order\":\"$order->id\"},
                    \"customer\":{\"first_name\":\"$user->name\",\"email\":\"$user->email\",
                    \"phone\":{\"country_code\":\"965\",\"number\":\"$user->phone\"}},
                    \"merchant\":{\"id\":\"$user->id\"},
                    \"source\":{\"id\":\"src_sa.mada\"},
                    \"redirect\":{\"url\":\"http://api.ketageaher.com/api/charge-order-redirect\"}
                }",

        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . config('app.payment_key'),
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $charge = json_decode($response, true);
        TapPayment::create([
            'charge_id' => $charge['id'],
            'amount' => $charge['amount'],
            'status' => $charge['status'],
            'orderable_id' => $order->id,
            'orderable_type' => 'App\Models\Order',
        ]);

        $order->payment_url = $charge['transaction']['url'];
        $order->save();

        return $charge;
    }
}
function generate_custom_order_payment_url($customOrder, $user)
{
    $price = $customOrder->payment_id == 1 ? $customOrder->price - ($customOrder->price * 80 / 100) : $customOrder->price;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>
        "{
                    \"amount\":$price,
                    \"currency\":\"SAR\",
                    \"description\":\"description\",
                    \"reference\":{\"order\":\"$customOrder->id\"},
                    \"customer\":{\"first_name\":\"$user->name\",\"email\":\"$user->email\",
                    \"phone\":{\"country_code\":\"965\",\"number\":\"$user->phone\"}},
                    \"merchant\":{\"id\":\"$user->id\"},
                    \"source\":{\"id\":\"src_sa.mada\"},
                    \"redirect\":{\"url\":\"http://api.ketageaher.com/api/charge-custom-order-redirect\"}
                }",

        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . config('app.payment_key'),
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return false;
    } else {

        $charge = json_decode($response, true);
        TapPayment::create([
            'charge_id' => $charge['id'],
            'amount' => $charge['amount'],
            'status' => $charge['status'],
            'orderable_id' => $customOrder->id,
            'orderable_type' => 'App\Models\CustomOrder',
        ]);

        $customOrder->payment_url = $charge['transaction']['url'];
        $customOrder->save();

        return $charge;
    }
}
