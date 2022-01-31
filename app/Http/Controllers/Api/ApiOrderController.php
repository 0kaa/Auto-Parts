<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\UpdateOrderStatus;
use App\Http\Resources\Api\OrderDetailsResource;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Repositories\CartItemRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;
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

class ApiOrderController extends Controller
{
    use ApiResponseTrait;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $orderItemRepository;
    protected $notificationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        CartRepositoryInterface $cartRepository,
        CartItemRepositoryInterface $cartItemRepository,
        NotificationRepositoryInterface $notificationRepository
    ) {

        $this->userRepository           = $userRepository;
        $this->productRepository        = $productRepository;
        $this->orderRepository          = $orderRepository;
        $this->orderItemRepository      = $orderItemRepository;
        $this->notificationRepository   = $notificationRepository;
        $this->cartRepository           = $cartRepository;
        $this->cartItemRepository       = $cartItemRepository;
    }

    public function CreateOrder(CreateOrderRequest $request)
    {
        try {
            $user = auth()->user();
            $total_amount = 0;

            $cart = $user->cart;

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


            // $notification = $this->notificationRepository->create([
            //     'user_id'       => $request->seller_id,
            //     'type'          => 'order',
            //     'model_id'      => $order->id,
            //     'message_en'    => 'You have a new order',
            //     'message_ar'    => 'لديك طلب جديد',
            // ]);

            // Notify::NotifyMob($notification->message_ar, $notification->message_en, $request->seller_id, null, $data = null);

            $cart->delete();

            return $this->ApiResponse(null, trans('local.order_done'), 200);
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

        if ($isOwnerStore) {

            $orders = $this->orderRepository->getWhereWith(['user'], ["seller_id" => $user->id]);

            $user_orders = [];
            $workshop_orders = [];


            $orders->each(function ($order) use (&$user_orders, &$workshop_orders) {
                if ($order->user->hasRole('workshop')) {
                    $workshop_orders[]  = $order;
                } else {
                    $user_orders[]      = $order;
                }
            });

            $user_orders        = OrderResource::collection($user_orders);
            $workshop_orders    = OrderResource::collection($workshop_orders);

            return $this->ApiResponse(compact('user_orders', 'workshop_orders'), null, 200);
        }

        $current_orders = OrderResource::collection($user->user_orders()->where('order_status', '<>', 'completed')->orderBy('created_at', 'ASC')->get());

        $previous_orders = OrderResource::collection($user->user_orders()->where('order_status', '=', 'completed')->get());

        return $this->ApiResponse(compact('current_orders', 'previous_orders'), null, 200);
    }

    public function orderStatus()
    {
        $order_status = OrderStatus::all();

        return $this->ApiResponse(OrderStatusResource::collection($order_status), null, 200);
    }
}
