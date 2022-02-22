<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\TapPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiPaymentController extends Controller
{

    use ApiResponseTrait;

    public function get_charge(Request $request)
    {
        $getCharge = TapPayment::where('charge_id', $request->tap_id)->first();

        $order = $getCharge->order;

        $api_key = 'sk_test_QCYkOjGn4l853sfmwRuyDoAB';

        $charge = Http::withToken($api_key)
            ->get('https://api.tap.company/v2/charges/' . $getCharge->charge_id)
            ->json();

        if ($charge['status'] == 'CAPTURED') {
            $order_status_paid = OrderStatus::where('slug', 'paid')->first();

            $getCharge->status = 'CAPTURED';
            $getCharge->save();

            $order->order_status_id = $order_status_paid->id;
            $order->payment_url = null;
            $order->save();

            return $this->ApiResponse(null, 'تم الدفع بنجاح', 200);
        } elseif ($charge['status'] == 'CANCELLED') {
            $order_status_cancelled = OrderStatus::where('slug', 'cancelled')->first();

            $getCharge->status = 'CANCELLED';
            $getCharge->save();
            $order->order_status_id = $order_status_cancelled->id;
            $order->save();

            return $this->ApiResponse(null, 'تم الغاء الدفع', 200);
        }
    }
}