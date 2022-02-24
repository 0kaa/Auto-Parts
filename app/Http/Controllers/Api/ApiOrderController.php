<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\UpdateOrderStatus;
use App\Http\Resources\Api\CustomOrderListResource;
use App\Http\Resources\Api\MultiCustomOrderResource;
use App\Http\Resources\Api\OrderDetailsResource;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Repositories\CartItemRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;
use App\Repositories\CustomOrderRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
use App\Services\Notify;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Api\OrderStatusResource;
use App\Models\OrderStatus;
use App\Models\TapPayment;

class ApiOrderController extends Controller
{
    use ApiResponseTrait;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $orderItemRepository;
    protected $notificationRepository;
    protected $customOrderRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        CartRepositoryInterface $cartRepository,
        CartItemRepositoryInterface $cartItemRepository,
        CustomOrderRepositoryInterface $customOrderRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {

        $this->userRepository           = $userRepository;
        $this->productRepository        = $productRepository;
        $this->orderRepository          = $orderRepository;
        $this->orderItemRepository      = $orderItemRepository;
        $this->notificationRepository   = $notificationRepository;
        $this->cartRepository           = $cartRepository;
        $this->cartItemRepository       = $cartItemRepository;
        $this->customOrderRepository    = $customOrderRepository;
    }

    public function CreateOrder(CreateOrderRequest $request)
    {
        try {
            $user = auth()->user();

            $total_amount = 0;

            $cart = $user->cart;

            if (!$cart) return $this->ApiResponse(null, trans('local.cart_empty'), 404);


            $cartItems = $cart->cart_items;

            $sellers = $cartItems->map(function ($item) {
                return $item->product->seller;
            });

            $sellers = $sellers->unique();


            $latestOrder = Order::orderBy('created_at', 'DESC')->first();

            foreach ($sellers as $seller) {

                $order = $this->orderRepository->create([
                    'user_id'               => $user->id,
                    'order_number'          => '#' . str_pad($latestOrder ? $latestOrder->id + 1 : 0 + 1, 4, "0", STR_PAD_LEFT),
                    'seller_id'             => $seller->id,
                    'order_ship_address'    => $request->order_ship_address,
                    'order_ship_name'       => $request->order_ship_name,
                    'order_ship_phone'      => $request->order_ship_phone,
                    'shipping_id'           => $request->shipping_id,
                    'total_amount'          => $total_amount,
                    'order_status_id'       => 1,
                ]);

                $total_amount = 0;

                foreach ($cartItems as $cartItem) {
                    if ($cartItem->product->seller->id == $seller->id) {

                        $this->orderItemRepository->create([
                            'order_id' => $order->id,
                            'product_id' => $cartItem->product->id,
                            'quantity' => $cartItem->quantity,
                            'price' => $cartItem->product->price,
                        ]);

                        $total_amount += $cartItem->product->price * $cartItem->quantity;
                        $order->total_amount = $total_amount;
                        $order->save();
                    }
                }
            }


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
                    \"redirect\":{\"url\":\"http://127.0.0.1:8000/api/charge-redirect\"}
                }",

                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer sk_test_QCYkOjGn4l853sfmwRuyDoAB",
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
            }



            // $notification = $this->notificationRepository->create([
            //     'user_id'       => $request->seller_id,
            //     'type'          => 'order',
            //     'model_id'      => $order->id,
            //     'message_en'    => 'You have a new order',
            //     'message_ar'    => 'لديك طلب جديد',
            // ]);

            // Notify::NotifyMob($notification->message_ar, $notification->message_en, $request->seller_id, null, $data = null);

            auth()->user()->cart()->delete();
                
            return $this->ApiResponse($charge['transaction']['url'], trans('local.order_done'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }




    public function currentOrders()
    {
        try {
            $user       = auth()->user();
            $orders     = $user->store_orders()->get();
            return $this->ApiResponse(OrderResource::collection($orders), null, 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }

    public function getOrder($id)
    {
        try {
            $order = $this->orderRepository->findOne($id);
            if ($order) {
                return $this->ApiResponse(new OrderDetailsResource($order), null, 200);
            } else {
                return $this->ApiResponse(null, trans('local.order_not_found'), 404);
            }
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }


    // Search Orders with date , name
    public function searchOrders(Request $request)
    {
        try {
            $user = auth()->user();

            // order db table
            $q = Order::query();

            // get my orders only
            $q->where('seller_id', $user->id);

            // search by start_date
            if ($request->has('start_date')) {
                $date = $request->start_date;
                $q->whereDate('created_at', '>=', $date);
            }

            // search by end_date
            if ($request->has('end_date')) {
                $date = $request->end_date;
                $q->whereDate('created_at', '<=', $date);
            }

            // search by order_status_id
            if ($request->has('order_status_id')) {
                $order_status_id = $request->order_status_id;
                $q->where('order_status_id', $order_status_id);
            }

            // search by user role user | workshop
            if ($request->has('type')) {
                $type = $request->type;
                if ($type == 'user') {
                    $q->whereHas('user', function ($q) {
                        $q->whereHas('roles', function ($q) {
                            $q->where('name', 'user');
                        });
                    });
                } else {
                    $q->whereHas('user', function ($q) {
                        $q->whereHas('roles', function ($q) {
                            $q->where('name', 'workshop');
                        });
                    });
                }
            }

            $orders = $q->get();

            return $this->ApiResponse(OrderResource::collection($orders), null, 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }


    public function updateOrderStatus(UpdateOrderStatus $request)
    {

        $order = $this->orderRepository->findOne($request->order_id);

        $orderStatus = OrderStatus::where('id', $request->order_status_id)->first();

        if (!$orderStatus) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 404);
        }

        if ($order && $order->seller_id == auth()->user()->id && $order->order_status->slug != 'completed') {
            if ($orderStatus->slug == 'completed') {
                $order->order_status_id = $orderStatus->id;
                $order->order_delivered_at = new DateTime();
                $order->save();
                return $this->ApiResponse(null, trans('local.order_status_updated'), 200);
            }
            $order->order_status_id = $orderStatus->id;
            $order->save();
            return $this->ApiResponse(null, trans('local.order_status_updated'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }
    }


    public function myOrders()
    {
        $isUser         = auth()->user()->hasRole('user');
        $isOwnerStore   = auth()->user()->hasRole('owner_store');
        $user           = auth()->user();
        $orderStatus    = OrderStatus::where('slug', 'completed')->first();
        $orderStatus_accepted    = OrderStatus::where('slug', 'accepted')->first();
        $orderStatus_rejected    = OrderStatus::where('slug', 'rejected')->first();
        $orderStatus_seller_rejected    = OrderStatus::where('slug', 'seller_rejected')->first();

        if ($isOwnerStore) {

            $orders = OrderResource::collection($user->store_orders()->where('order_status_id', '<>', $orderStatus->id)->orderBy('created_at', 'ASC')->get());

            $custom_orders = MultiCustomOrderResource::collection($user->store_custom_orders()->where('order_status_id', '<>', $orderStatus_accepted->id)->where('order_status_id', '<>', $orderStatus_seller_rejected->id)->where('order_status_id', '<>', $orderStatus_rejected->id)->orderBy('created_at', 'ASC')->get());

            $previous_orders = OrderResource::collection($user->store_orders()->where('order_status_id', '=', $orderStatus->id)->orderBy('created_at', 'ASC')->get());

            $previous_custom_orders = MultiCustomOrderResource::collection($user->store_custom_orders()->where('order_status_id', '=', $orderStatus_accepted->id)->orderBy('created_at', 'ASC')->get());

            return $this->ApiResponse(compact('orders', 'custom_orders', 'previous_orders', 'previous_custom_orders'), null, 200);
        }

        $orders = OrderResource::collection($user->user_orders()->where('order_status_id', '<>', $orderStatus->id)->orderBy('created_at', 'ASC')->get());

        $custom_orders = CustomOrderListResource::collection($user->user_custom_orders()->where('order_status_id', '<>', $orderStatus_accepted->id)->where('order_status_id', '<>', $orderStatus_seller_rejected->id)->where('order_status_id', '<>', $orderStatus_rejected->id)->orderBy('created_at', 'ASC')->get());

        $previous_orders = OrderResource::collection($user->user_orders()->where('order_status_id', '=', $orderStatus->id)->orderBy('created_at', 'ASC')->get());

        $previous_custom_orders = CustomOrderListResource::collection($user->user_custom_orders()->where('order_status_id', '=', $orderStatus_accepted->id)->orderBy('created_at', 'ASC')->get());

        return $this->ApiResponse(compact('orders', 'custom_orders', 'previous_orders', 'previous_custom_orders'), null, 200);
    }

    public function orderStatus()
    {
        $order_status = OrderStatus::all();

        return $this->ApiResponse(OrderStatusResource::collection($order_status), null, 200);
    }
}
