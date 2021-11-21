<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\CustomOrderResource;
use App\Http\Resources\Api\PriceOffersResource;
use App\Repositories\CustomOrderRepositoryInterface;

class ApiCustomOrderController extends Controller
{
    use ApiResponseTrait;
    private $customOrderRepository;

    public function __construct(CustomOrderRepositoryInterface $customOrderRepository)
    {
        $this->customOrderRepository = $customOrderRepository;
    }

    public function CreateCustomOrder(Request $request)
    {
        $user = auth()->user();
        $attributes = $request->all();
        $customOrder = $this->customOrderRepository->create([
            'user_id'           => $user->id,
            'seller_id'         => $attributes['seller_id'],
            "piece_name"        => $attributes['piece_name'],
            "piece_image"       => $attributes['piece_image'],
            "car_id"            => $attributes['car_id'],
            'activity_type_id'  => $attributes['activity_type_id'],
            'sup_activity_id'   => $attributes['sup_activity_id'],
            'order_data'        => $attributes['order_data'],
        ]);

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    public function sellerAcceptedOrder(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->order_status != 'pending') {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        if ($customOrder->seller_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $attributes = $request->all();

        if (!isset($attributes['order_status']) || !isset($attributes['piece_price'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($attributes['order_status'] == 'seller_accepted') {

            $this->customOrderRepository->update(['order_status' => $attributes['order_status'], 'piece_price' => $attributes['piece_price']], $id);

            return $this->ApiResponse(null, trans('local.order_done'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }

    public function sellerRejectedOrder(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->order_status != 'pending') {
            return $this->ApiResponse(null, trans('local.order_already_rejected'), 403);
        }

        if ($customOrder->seller_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $attributes = $request->all();

        if (!isset($attributes['order_status'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($attributes['order_status'] == 'seller_rejected') {

            $this->customOrderRepository->update(['order_status' => $attributes['order_status']], $id);

            return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }

    public function userAcceptedOrders(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->order_status != 'seller_accepted') {
            return $this->ApiResponse(null, trans('local.order_not_accepted'), 403);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $attributes = $request->all();

        if (!isset($attributes['order_status'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($attributes['order_status'] == 'accepted') {

            $this->customOrderRepository->update(['order_status' => $attributes['order_status']], $id);

            return $this->ApiResponse(null, trans('local.order_done'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }

    public function userRejectedOrders(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->order_status != 'seller_accepted') {
            return $this->ApiResponse(null, trans('local.order_not_accepted'), 403);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $attributes = $request->all();

        if (!isset($attributes['order_status'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($attributes['order_status'] == 'rejected') {

            $this->customOrderRepository->update(['order_status' => $attributes['order_status']], $id);

            return $this->ApiResponse(null, trans('local.order_status_updated'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }


    public function getPriceOffers()
    {
        $user = auth()->user();

        $customOrders = $this->customOrderRepository->getWhere(['user_id' => $user->id, 'order_status' => 'seller_accepted']);

        return $this->ApiResponse(PriceOffersResource::collection($customOrders), null, 200);
    }

    public function getSellerOrders()
    {
        $user = auth()->user();

        $customOrders = $this->customOrderRepository->getWhere(['seller_id' => $user->id, 'order_status' => 'pending']);

        return $this->ApiResponse(CustomOrderResource::collection($customOrders), null, 200);
    }

    public function getOrder($id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if ($customOrder->user_id == $user->id) {
            return $this->ApiResponse(new CustomOrderResource($customOrder), null, 200);
        } elseif ($customOrder->seller_id == $user->id) {
            return $this->ApiResponse(new CustomOrderResource($customOrder), null, 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }
    }
}
