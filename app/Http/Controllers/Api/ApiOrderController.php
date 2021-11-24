<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
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


    // OrdersByDate using whereDate
    public function filterOrders(Request $request)
    {
        $user = auth()->user();

        $orders = $user->store_orders()->orderBy('created_at', 'ASC')->get();

        if ($request->start_date && $request->end_date && $request->order_status) {
            $orders = $user->store_orders()
                ->whereDate(
                    'created_at',
                    '>=',
                    date("Y-m-d", strtotime($request->start_date))
                )
                ->whereDate(
                    'created_at',
                    '<=',
                    date("Y-m-d", strtotime($request->end_date))
                )->where('order_status', $request->order_status)->orderBy('created_at', 'ASC')->get();
        }

        if ($request->start_date) {
            $orders = $user->store_orders()->whereDate('created_at', '>=', date("Y-m-d", strtotime($request->start_date)))->orderBy('created_at', 'ASC')->get();
        }

        if ($request->order_status) {
            $orders = $user->store_orders()->where('order_status', $request->order_status)->orderBy('created_at', 'ASC')->get();
        }

        if ($request->start_date && $request->order_status) {
            $orders = $user->store_orders()->whereDate('created_at', '>=', date("Y-m-d", strtotime($request->start_date)))->where('order_status', $request->order_status)->orderBy('created_at', 'ASC')->get();
        }
        return $this->ApiResponse(OrderResource::collection($orders), null, 200);
    }


    public function updateOrderStatus(UpdateOrderStatus $request)
    {

        $order = $this->orderRepository->findOne($request->order_id);

        if ($order && $order->seller_id == auth()->user()->id) {
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

        if ($isUser) {

            $current_orders = OrderResource::collection($user->user_orders()->where('order_status', '<>', 'completed')->orderBy('created_at', 'ASC')->get());

            $previous_orders = OrderResource::collection($user->user_orders()->where('order_status', '=', 'completed')->get());

            return $this->ApiResponse(compact('current_orders', 'previous_orders'), null, 200);
        } elseif ($isOwnerStore) {

            $orders = $user->store_orders()->orderBy('created_at', 'ASC')->get();

            return $this->ApiResponse(OrderResource::collection($orders), null, 200);
        }
    }

    public function CreateOrder(Request $request)
    {
        try {
            $user = auth()->user();
            $total_amount = 0;

            foreach ($request->products as $product) {
                $total_amount += $product['price'] * $product['quantity'];
            }

            $latestOrder = Order::orderBy('created_at', 'DESC')->first();
            
            // dd($latestOrder->id);
            $order = $this->orderRepository->create([
                'user_id'       => $user->id,
                'order_number'  => '#' . str_pad($latestOrder ? $latestOrder->id + 1 : 0 + 1, 4, "0", STR_PAD_LEFT),
                'seller_id'     => $request->seller_id,
                'order_address' => $request->order_address,
                'total_amount'  => $total_amount,
                'order_status'  => 'pending',
            ]);

            foreach ($request->products as $product) {
                $this->orderItemRepository->create([
                    'order_id'      => $order->id,
                    'product_id'    => $product['id'],
                    'quantity'      => $product['quantity'],
                    'price'         => $product['price'],
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
}
