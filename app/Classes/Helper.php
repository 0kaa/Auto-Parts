<?php

use App\Models\MultiCustomOrder;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderStatus;
use App\Models\TapPayment;
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

function send_activation_code($numbers, $msg, $timeSend = 0, $dateSend = 0, $deleteKey = 0, $viewResult = 1)
{
    $client = new \GuzzleHttp\Client();
    $url = "http://api.yamamah.com/SendSMSV2?Username=966595070182&Password=Jq5NE7n^3u9X&Tagname=muhtarf&RecepientNumber=$numbers&Message=$msg&SendDateTime=0&EnableDR=true&SentMessageID=true";

    $request = $client->get($url, [
        'form_params' => [
            '_token' => csrf_field()
        ]
    ]);
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
        $customOrder->update(['order_status_id' => $order_status_not_found->id]);
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
                    \"amount\":$order->total_amount,
                    \"currency\":\"SAR\",
                    \"description\":\"description\",
                    \"reference\":{\"order\":\"$order->id\"},
                    \"customer\":{\"first_name\":\"$user->name\",\"email\":\"$user->email\",
                    \"phone\":{\"country_code\":\"965\",\"number\":\"$user->phone\"}},
                    \"merchant\":{\"id\":\"$user->id\"},
                    \"source\":{\"id\":\"src_sa.mada\"},
                    \"redirect\":{\"url\":\"http://api.ketageaher.com/api/charge-redirect\"}
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
            'order_id' => $order->id,
        ]);

        $order->payment_url = $charge['transaction']['url'];
        $order->save();

        return $charge;
    }
}

