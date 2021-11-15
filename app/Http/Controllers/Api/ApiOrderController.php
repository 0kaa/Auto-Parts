<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateOrderStatus;
use App\Http\Resources\Api\OrderResource;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
use DateTime;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    use ApiResponseTrait;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $orderItemRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository
    ) {

        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
        $this->orderRepository  = $orderRepository;
        $this->orderItemRepository  = $orderItemRepository;
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
        $user = auth()->user();

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
        $user_id = auth()->user()->id;
        $grand_total = 0;
        foreach ($request->products as $product) {
            $grand_total += $product['price'] * $product['quantity'];
        }

        $order = $this->orderRepository->create([
            'user_id' => $user_id,
            'seller_id' => $request->seller_id,
            'order_address' => $request->order_address,
            'grand_total' => $grand_total,
            'order_status' => 'pending',
        ]);

        foreach ($request->products as $product) {
            $this->orderItemRepository->create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }
}
