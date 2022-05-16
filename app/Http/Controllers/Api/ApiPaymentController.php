<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PaymentMethodsResource;
use App\Models\Notification;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\TapPayment;
use App\Models\User;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiPaymentController extends Controller
{

    use ApiResponseTrait;

    public function payment_methods()
    {
        $payment_methods = PaymentMethod::all();
        return $this->ApiResponse(PaymentMethodsResource::collection($payment_methods), null, 200);
    }

    public function charge_order(Request $request)
    {
        $getCharge = TapPayment::where('charge_id', $request->tap_id)->first();

        if (!$getCharge) {
            return $this->ApiResponse(null, trans('local.charge_not_found'), 404);
        }

        $order = $getCharge->order;

        $api_key = config('app.payment_key');

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

            $notification = Notification::create([
                'user_id'       => $order->seller_id,
                'type'          => 'order',
                'model_id'      => $order->id,
                'message_en'    => 'Order #' . $order->id . ' has been paid successfully by ' . $order->user->name,
                'message_ar'    => 'تم دفع الطلب #' . $order->id . ' بنجاح بواسطة ' . $order->user->name,
            ]);

            $seller = User::find($order->seller_id);

            $seller->wallet->balance += $order->total_amount;
            $seller->wallet->save();

            Notify::NotifyMob($notification->message_ar, $notification->message_en, $order->seller_id, null, $data = null);

            return $this->ApiResponse(null, trans('local.payment_success'), 200);
        } elseif ($charge['status'] == 'CANCELLED') {
            $order_status_unpaid = OrderStatus::where('slug', 'unpaid')->first();

            $getCharge->status = 'CANCELLED';
            $getCharge->save();

            $order->order_status_id = $order_status_unpaid->id;
            $order->payment_url = null;

            $order->save();

            return $this->ApiResponse(null, trans('local.payment_failed'), 200);
        }
    }

    public function charge_custom_order(Request $request)
    {
        $getCharge = TapPayment::where('charge_id', $request->tap_id)->first();

        if (!$getCharge) {
            return $this->ApiResponse(null, trans('local.charge_not_found'), 404);
        }

        $api_key = config('app.payment_key');

        $order = $getCharge->custom_order;

        $charge = Http::withToken($api_key)
            ->get('https://api.tap.company/v2/charges/' . $getCharge->charge_id)
            ->json();

        if ($charge['status'] == 'CAPTURED') {
            $order_status_paid  = OrderStatus::where('slug', 'paid')->first();

            $getCharge->status = 'CAPTURED';
            $getCharge->save();

            $order->order_status_id                     = $order_status_paid->id;
            $order->payment_url                         = null;
            $order->multiCustomOrder->order_status_id   = $order_status_paid->id;
            $order->save();
            $order->multiCustomOrder->save();

            $notification = Notification::create([
                'user_id'       => $order->seller_id,
                'type'          => 'custom_order',
                'model_id'      => $order->id,
                'message_en'    => 'Order #' . $order->id . ' has been paid successfully by ' . $order->user->name,
                'message_ar'    => 'تم دفع الطلب #' . $order->id . ' بنجاح بواسطة ' . $order->user->name,
            ]);

            $seller = User::find($order->seller_id);

            $seller->wallet->balance += $order->total_amount;
            $seller->wallet->save();

            Notify::NotifyMob($notification->message_ar, $notification->message_en, $order->seller_id, null, $data = null);

            return $this->ApiResponse(null, trans('local.payment_success'), 200);
        } elseif ($charge['status'] == 'CANCELLED') {
            $order_status_unpaid = OrderStatus::where('slug', 'unpaid')->first();

            $getCharge->status = 'CANCELLED';
            $getCharge->save();

            $order->order_status_id                     = $order_status_unpaid->id;
            $order->payment_url                         = null;
            $order->multiCustomOrder->order_status_id   = $order_status_unpaid->id;

            $order->save();
            $order->multiCustomOrder->save();

            return $this->ApiResponse(null, trans('local.payment_failed'), 200);
        }
    }
}
