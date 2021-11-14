<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;
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

    public function myOrders()
    {
        $isUser         = auth()->user()->hasRole('user');
        $isOwnerStore   = auth()->user()->hasRole('owner_store');

        $user = $this->userRepository->findOne(auth()->user()->id);

        if ($isUser) {
            $orders = $user->user_orders()->get();
        } elseif ($isOwnerStore) {
            $orders = $user->store->store_orders()->get();
        }

        return $this->ApiResponse(OrderResource::collection($orders), null, 200);
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
            'order_date' => date('Y-m-d'),
            'order_time' => date('H:i:s'),
        ]);

        foreach ($request->products as $product) {
            $this->orderItemRepository->create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        return $this->ApiResponse($order, null, 200);
    }
}
