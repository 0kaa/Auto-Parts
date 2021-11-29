<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\CustomOrderListResource;
use App\Http\Resources\Api\CustomOrderDetailsResource;
use App\Http\Resources\Api\PriceOffersResource;
use App\Models\MultiCustomOrder;
use App\Models\RejectedOrders;
use App\Models\User;
use App\Repositories\CustomOrderRepositoryInterface;
use App\Repositories\PriceOfferRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;


class ApiCustomOrderController extends Controller
{
    use ApiResponseTrait;
    private $customOrderRepository;
    private $priceOfferRepository;
    private $userRepository;

    protected $filesServices;

    private $customOrderDirectory = 'custom_order';

    public function __construct(
        CustomOrderRepositoryInterface $customOrderRepository,
        UploadFilesServices $filesServices,
        PriceOfferRepositoryInterface $priceOfferRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->customOrderRepository    = $customOrderRepository;
        $this->priceOfferRepository     = $priceOfferRepository;
        $this->filesServices            = $filesServices;
        $this->userRepository           = $userRepository;
    }

    // Step 1 in custom order -> Created Order
    public function CreateCustomOrder(Request $request)
    {
        $user           = auth()->user();
        $attributes     = $request->all();
        $piece_image    = '';
        $form_image     = '';


        if ($request->hasFile('piece_image')) {
            $img = $request->file('piece_image');
            $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
        }

        if ($request->hasFile('form_image')) {
            $form_img = $request->file('form_image');
            $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
        }

        $customOrder =  $this->customOrderRepository->create([
            'seller_id'         => $attributes['seller_id'],
            'user_id'           => $user->id,
            "piece_name"        => $attributes['piece_name'],
            "piece_image"       => $piece_image,
            'form_image'        => $form_image,
            "car_id"            => $attributes['car_id'],
            'activity_type_id'  => $attributes['activity_type_id'],
            'sub_activity_id'   => $attributes['sub_activity_id'],
            'order_data'        => $attributes['order_data'],
        ]);

        MultiCustomOrder::create([
            'seller_id' => $attributes['seller_id'],
            'custom_order_id' => $customOrder->id
        ]);

        // Notification to seller

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    public function CreateMultiCustomOrder(Request $request)
    {
        $user           = auth()->user();
        $attributes     = $request->all();
        $piece_image    = '';
        $form_image     = '';

        $sellers = User::whereRelation('roles', 'name', 'owner_store')
            ->where('activity_type_id', $request->activity_type_id)
            ->limit(5)->get();

        if ($request->hasFile('piece_image')) {
            $img = $request->file('piece_image');
            $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
        }

        if ($request->hasFile('form_image')) {
            $form_img = $request->file('form_image');
            $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
        }

        $customOrder = $this->customOrderRepository->create([
            'user_id'           => $user->id,
            "piece_name"        => $attributes['piece_name'],
            "piece_image"       => $piece_image,
            'form_image'        => $form_image,
            "car_id"            => $attributes['car_id'],
            'activity_type_id'  => $attributes['activity_type_id'],
            'sub_activity_id'   => $attributes['sub_activity_id'],
            'order_data'        => $attributes['order_data'],
        ]);

        foreach ($sellers as $seller) {
            MultiCustomOrder::create([
                'seller_id' => $seller->id,
                'custom_order_id' => $customOrder->id
            ]);
        }


        // Notification to seller

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    /**
     * Step 2 include 2 ways [accept | reject] if seller accept order from user he will send the price offer
     */
    public function sellerAcceptedOrder(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        $priceOffer = $this->priceOfferRepository->getWhere([['custom_order_id', $customOrder->id], ['seller_id', $user->id]]);

        if ($priceOffer->isNotEmpty()) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }


        $attributes = $request->all();

        if (!isset($attributes['order_status']) || !isset($attributes['price'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        $this->priceOfferRepository->create([
            'custom_order_id'   => $customOrder->id,
            'seller_id'         => $user->id,
            'price'             => $attributes['price'],
            'status'            => 'pending',
            'note'              => $attributes['note'] ?? null,
        ]);

        // Notification

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    /**
     * Step 2 if seller reject the order in this case the order will redirect automatic to another seller with same data in this seller
     */
    public function sellerRejectedOrder(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->seller_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $priceOffer = $this->priceOfferRepository->getWhere([['custom_order_id', $customOrder->id], ['seller_id', $user->id]]);

        if ($priceOffer->isNotEmpty()) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 403);
        }


        if (!isset($request->order_status)) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($request->order_status == 'seller_rejected') {

            $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

            if (in_array($customOrder->seller_id, $rejectedOrder->toArray()) == false) {
                RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $customOrder->seller_id]);
            }

            RedirectOrderToAnotherUser($customOrder->seller_id, $rejectedOrder, $customOrder);

            return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }

    /**
     * Step 3 => in case the seller accepted order and send price offer here user can take one of two actions [accept | reject] 
     */
    public function AcceptPriceOffer(Request $request, $id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        $customOrder = $this->customOrderRepository->findOne($priceOffer->custom_order_id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        if ($priceOffer->status == 'accepted') {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        if (!isset($request->order_status)) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        if ($request->order_status == 'accepted') {

            $priceOffer->update(['status' => 'accepted']);
            $priceOffer->save();

            $customOrder->update([
                'order_status'  => 'accepted',
                'piece_price'   => $priceOffer->price,
                'seller_id'     => $priceOffer->seller_id
            ]);
            $customOrder->save();

            return $this->ApiResponse(null, trans('local.order_done'), 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }
    }

    public function RejectPriceOffer(Request $request, $id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        $customOrder = $this->customOrderRepository->findOne($priceOffer->custom_order_id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        if ($priceOffer->status == 'accepted') {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        $attributes = $request->all();

        if (!isset($attributes['order_status'])) {
            return $this->ApiResponse(null, trans('local.order_status_required'), 400);
        }

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (in_array($customOrder->seller_id, $rejectedOrder->toArray()) == false) {
            RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $customOrder->seller_id]);
        }

        RedirectOrderToAnotherUser($customOrder->seller_id, $rejectedOrder, $customOrder);

        return $this->ApiResponse(null, trans('local.order_status_updated'), 200);
    }




    public function PriceOffers($id)
    {

        $priceOffers = $this->priceOfferRepository->getWhere([['custom_order_id', $id]]);

        return $this->ApiResponse(PriceOffersResource::collection($priceOffers), null, 200);
    }

    public function userOrders()
    {
        $user = auth()->user();

        $customOrders = $this->customOrderRepository->getWhere([['user_id', $user->id]]);

        return $this->ApiResponse(CustomOrderListResource::collection($customOrders), null, 200);
    }

    public function getSellerOrders()
    {
        $user = auth()->user();

        $customOrders = $this->customOrderRepository->whereHas('multiCustomOrder', ['seller_id' => $user->id], []);

        return $this->ApiResponse(CustomOrderDetailsResource::collection($customOrders), null, 200);
    }

    public function getOrder($id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id == $user->id) {
            return $this->ApiResponse(new CustomOrderDetailsResource($customOrder), null, 200);
        } elseif ($customOrder->seller_id == $user->id) {
            return $this->ApiResponse(new CustomOrderDetailsResource($customOrder), null, 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }
    }
}
