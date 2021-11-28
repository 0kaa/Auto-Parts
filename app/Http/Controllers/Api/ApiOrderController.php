<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\UpdateOrderStatus;
use App\Http\Resources\Api\OrderDetailsResource;
use App\Http\Resources\Api\OrderResource;
use App\Models\Order;
use App\Repositories\NotificationRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
use App\Services\Notify;
use DateTime;
use Illuminate\Http\Request;

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
        NotificationRepositoryInterface $notificationRepository
    ) {

        $this->userRepository           = $userRepository;
        $this->productRepository        = $productRepository;
        $this->orderRepository          = $orderRepository;
        $this->orderItemRepository      = $orderItemRepository;
        $this->notificationRepository   = $notificationRepository;
    }

    public function CreateOrder(CreateOrderRequest $request)
    {
        try {
            $user = auth()->user();
            $total_amount = 0;

            foreach ($request->products as $product) {
                $product_model = $this->productRepository->findOne($product['id']);
                $total_amount += $product_model->price * $product['quantity'];
            }

            $latestOrder = Order::orderBy('created_at', 'DESC')->first();

            $order = $this->orderRepository->create([
                'user_id'               => $user->id,
                'order_number'          => '#' . str_pad($latestOrder ? $latestOrder->id + 1 : 0 + 1, 4, "0", STR_PAD_LEFT),
                'seller_id'             => $request->seller_id,
                'order_ship_address'    => $request->order_ship_address,
                'order_ship_name'       => $request->order_ship_name,
                'order_ship_phone'      => $request->order_ship_phone,
                'shipping_id'           => $request->shipping_id,
                'total_amount'          => $total_amount,
                'order_status'          => 'pending',
            ]);

            foreach ($request->products as $product) {
                $product_model = $this->productRepository->findOne($product['id']);
                $this->orderItemRepository->create([
                    'order_id'      => $order->id,
                    'product_id'    => $product['id'],
                    'quantity'      => $product['quantity'],
                    'price'         => $product_model->price,
                ]);
            }

            // $notification = $this->notificationRepository->create([
            //     'user_id'       => $request->seller_id,
            //     'type'          => 'order',
            //     'model_id'      => $order->id,
            //     'message_en'    => 'You have a new order',
            //     'message_ar'    => 'لديك طلب جديد',
            // ]);

            // Notify::NotifyMob($notification->message_ar, $notification->message_en, $request->seller_id, null, $data = null);

            return $this->ApiResponse(null, trans('local.order_done'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }

    public function getOrder($id)
    {
        $order = $this->orderRepository->findOne($id);

        if ($order) {
            return $this->ApiResponse(new OrderDetailsResource($order), null, 200);
        } else {
            return $this->ApiResponse(null, null, 404);
        }
    }


    // Search Orders with date , name
    public function searchOrders(Request $request)
    {
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

        // search by order_status
        if ($request->has('order_status')) {
            $order_status = $request->order_status;
            $q->where('order_status', $order_status);
        }

        $orders = $q->get();

        return $this->ApiResponse(OrderResource::collection($orders), null, 200);
    }


    public function updateOrderStatus(UpdateOrderStatus $request)
    {

        $order = $this->orderRepository->findOne($request->order_id);

        if ($order && $order->seller_id == auth()->user()->id && $order->order_status != 'delivered') {
            if ($request->order_status == 'delivered') {
                $order->order_status = $request->order_status;
                $order->order_delivered_at = new DateTime();
                $order->save();
                return $this->ApiResponse(null, trans('local.order_status_updated'), 200);
            }
            $order->order_status = $request->order_status;
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
            $shop_orders = [];

            $orders->each(function ($order) use (&$user_orders, &$workshop_orders, &$shop_orders) {
                if ($order->user->hasRole('owner_store')) {
                    $shop_orders[]      = $order;
                } elseif ($order->user->hasRole('workshop')) {
                    $workshop_orders[]  = $order;
                } else {
                    $user_orders[]      = $order;
                }
            });

            $user_orders        = OrderResource::collection($user_orders);
            $workshop_orders    = OrderResource::collection($workshop_orders);
            $shop_orders        = OrderResource::collection($shop_orders);

            return $this->ApiResponse(compact('user_orders', 'workshop_orders', 'shop_orders'), null, 200);
        }

        $current_orders = OrderResource::collection($user->user_orders()->where('order_status', '<>', 'completed')->orderBy('created_at', 'ASC')->get());

        $previous_orders = OrderResource::collection($user->user_orders()->where('order_status', '=', 'completed')->get());

        return $this->ApiResponse(compact('current_orders', 'previous_orders'), null, 200);
    }
}
