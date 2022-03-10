<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\CustomOrderListResource;
use App\Http\Resources\Api\CustomOrderDetailsResource;
use App\Http\Resources\Api\PriceOffersResource;
use App\Models\MultiCustomOrder;
use App\Models\Notification;
use App\Models\OrderStatus;
use App\Models\RejectedOrders;
use App\Models\User;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\CustomOrderRepositoryInterface;
use App\Repositories\PriceOfferRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttributeRepositoryInterface;
use App\Repositories\SubActivityTypeRepositoryInterface;
use App\Services\Notify;

class ApiCustomOrderController extends Controller
{
    use ApiResponseTrait;
    private $customOrderRepository;
    private $priceOfferRepository;
    private $userRepository;
    private $attributeRepository;
    private $activityTypeRepository;
    private $subActivityTypeRepository;

    protected $filesServices;

    private $customOrderDirectory = 'custom_order';

    public function __construct(
        CustomOrderRepositoryInterface $customOrderRepository,
        UploadFilesServices $filesServices,
        PriceOfferRepositoryInterface $priceOfferRepository,
        UserRepositoryInterface $userRepository,
        AttributeRepositoryInterface $attributeRepository,
        ActivityTypeRepositoryInterface $activityTypeRepository,
        SubActivityTypeRepositoryInterface $subActivityTypeRepository
    ) {
        $this->customOrderRepository    = $customOrderRepository;
        $this->priceOfferRepository     = $priceOfferRepository;
        $this->filesServices            = $filesServices;
        $this->userRepository           = $userRepository;
        $this->attributeRepository      = $attributeRepository;
        $this->activityTypeRepository   = $activityTypeRepository;
        $this->subActivityTypeRepository = $subActivityTypeRepository;
    }

    // Step 1 in custom order -> Created Order
    public function CreateCustomOrder(Request $request)
    {
        $user           = auth()->user();
        $attributes     = $request->all();
        $piece_image    = '';
        $form_image     = '';

        $activity       = $this->activityTypeRepository->findOne($attributes['activity_type_id']);

        if (!$activity) {
            return $this->ApiResponse(null, trans('local.activity_id_not_found'), 404);
        }

        $sub_activity       = $activity->sub_activity()->where('id', $attributes['sub_activity_id'])->first();
        $sub_sub_activity   = null;

        if (!$sub_activity) {
            return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
        }

        if ($activity->id == 6) {
            if ($request->sub_sub_activity_id) {
                $sub_sub_activity = $activity->sub_activity()->where('id', $request->sub_sub_activity_id)->where('parent_id', $sub_activity->id)->first();
                if (!$sub_sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
            } else {
                return $this->ApiResponse(null, trans('local.sub_sub_activity_required'), 404);
            }
        }

        if ($request->hasFile('piece_image')) {
            $img = $request->file('piece_image');
            $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
        }

        if ($request->hasFile('form_image')) {
            $form_img = $request->file('form_image');
            $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
        }

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $customOrder =  $this->customOrderRepository->create([
            'seller_id'             => $attributes['seller_id'],
            'user_id'               => $user->id,
            "piece_name"            => $attributes['piece_name'],
            "piece_image"           => $piece_image,
            'note'                  => $attributes['note'],
            'form_image'            => $form_image,
            "car_id"                => $attributes['car_id'],
            'shipping_id'           => $attributes['shipping_id'],
            'payment_id'            => $attributes['payment_id'],
            'order_status_id'       => $order_status_pending->id,
            'quantity'              => $request->quantity ? $request->quantity : 1,
            'activity_type_id'      => $activity->id,
            'sub_activity_id'       => $sub_activity->id,
            'sub_sub_activity_id'   => $sub_sub_activity ? $sub_sub_activity->id : null,
        ]);

        if ($request->get('attributes')) {
            foreach ($request->get('attributes') as $key => $attribute) {

                $attribute_id   = $this->attributeRepository->findOne($attribute['attribute_id']);

                if (!$attribute_id) {

                    if (isset($customOrder->piece_image)) {
                        Storage::delete($customOrder->piece_image);
                    }

                    if (isset($customOrder->form_image)) {
                        Storage::delete($customOrder->form_image);
                    }

                    $customOrder->delete();

                    return $this->ApiResponse(null, trans('local.attribute_not_found'), 404);
                }

                if ($attribute_id->type == 'select') {
                    $attribute_option = $attribute_id->options->where('id', $attribute['option_id'])->first();

                    if (!$attribute_option) {

                        if (isset($customOrder->piece_image)) {
                            Storage::delete($customOrder->piece_image);
                        }

                        if (isset($customOrder->form_image)) {
                            Storage::delete($customOrder->form_image);
                        }

                        $customOrder->delete();

                        return $this->ApiResponse(null, trans('local.option_not_found'), 404);
                    }
                } else {
                    $attribute_option = null;

                    if ($attribute_id->type == 'file') {
                        if ($request->file('attributes')) {

                            $file = $request->file('attributes')[$key]['image'];

                            $value = $this->filesServices->uploadfile($file, $this->customOrderDirectory);
                        } else {

                            if (isset($customOrder->piece_image)) {
                                Storage::delete($customOrder->piece_image);
                            }

                            if (isset($customOrder->form_image)) {
                                Storage::delete($customOrder->form_image);
                            }

                            $customOrder->delete();

                            return $this->ApiResponse(null, trans('local.file_required'), 404);
                        }
                    }
                }

                $customOrder->attributes()->create([
                    'attribute_id' => $attribute_id->id,
                    'option_id'    => $attribute_option ? $attribute_option->id : null,
                    'type'         => $attribute_id->type,
                    'value'        => $attribute_id->type == 'file' ? $value : ($attribute_id->type !== 'select' ? $attribute['value'] : null),
                ]);
            }
        }


        MultiCustomOrder::create([
            'seller_id' => $attributes['seller_id'],
            'custom_order_id' => $customOrder->id,
            'order_status_id' => $order_status_pending->id
        ]);

        // Notification to seller
        $notification = Notification::create([
            'user_id'       => $request->seller_id,
            'type'          => 'custom_order',
            'model_id'      => $customOrder->id,
            'message_en'    => 'New order from ' . $user->name,
            'message_ar'    => 'طلب جديد من ' . $user->name,
        ]);

        Notify::NotifyMob($notification->message_ar, $notification->message_en, $request->seller_id, null, $data = null);

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    public function CreateMultiCustomOrder(Request $request)
    {
        $user           = auth()->user();
        $attributes     = $request->all();
        $piece_image    = '';
        $form_image     = '';

        $activity       = $this->activityTypeRepository->findOne($attributes['activity_type_id']);

        if (!$activity) {
            return $this->ApiResponse(null, trans('local.activity_id_not_found'), 404);
        }

        $sub_activity       = $activity->sub_activity()->where('id', $attributes['sub_activity_id'])->first();
        $sub_sub_activity   = null;

        if (!$sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);

        if ($activity->id == 6) {
            if ($request->sub_sub_activity_id) {
                $sub_sub_activity = $activity->sub_activity()->where('id', $request->sub_sub_activity_id)->where('parent_id', $sub_activity->id)->first();
                if (!$sub_sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
            } else {
                return $this->ApiResponse(null, trans('local.sub_sub_activity_required'), 404);
            }
        }

        $sellers = User::whereRelation('roles', 'name', 'owner_store')->where('activity_type_id', $request->activity_type_id)->limit(5)->get();

        if ($sellers->count() == 0) return $this->ApiResponse(null, trans('local.sellers_not_founded_in_this_activity'), 404);

        if ($request->hasFile('piece_image')) {
            $img = $request->file('piece_image');
            $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
        }

        if ($request->hasFile('form_image')) {
            $form_img = $request->file('form_image');
            $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
        }

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $customOrder =  $this->customOrderRepository->create([
            'user_id'               => $user->id,
            "piece_name"            => $attributes['piece_name'],
            "piece_image"           => $piece_image,
            'note'                  => $attributes['note'],
            'form_image'            => $form_image,
            "car_id"                => $attributes['car_id'],
            'order_status_id'       => $order_status_pending->id,
            'shipping_id'           => $attributes['shipping_id'],
            'payment_id'            => $attributes['payment_id'],
            'quantity'              => $request->quantity ? $request->quantity : 1,
            'activity_type_id'      => $activity->id,
            'sub_activity_id'       => $sub_activity->id,
            'sub_sub_activity_id'   => $sub_sub_activity ? $sub_sub_activity->id : null,
        ]);

        if ($request->get('attributes')) {
            foreach ($request->get('attributes') as $key => $attribute) {

                $attribute_id   = $this->attributeRepository->findOne($attribute['attribute_id']);

                if ($attribute_id->sub_activity_id != $sub_activity->id) {
                    return $this->ApiResponse(null, trans('local.attribute_not_belong_to_sub_activity'), 404);
                }

                if (!$attribute_id) {

                    if (isset($customOrder->piece_image)) {
                        Storage::delete($customOrder->piece_image);
                    }

                    if (isset($customOrder->form_image)) {
                        Storage::delete($customOrder->form_image);
                    }

                    $customOrder->delete();

                    return $this->ApiResponse(null, trans('local.attribute_not_found'), 404);
                }

                if ($attribute_id->type == 'select') {
                    $attribute_option = $attribute_id->options->where('id', $attribute['option_id'])->first();

                    if (!$attribute_option) {

                        if (isset($customOrder->piece_image)) {
                            Storage::delete($customOrder->piece_image);
                        }

                        if (isset($customOrder->form_image)) {
                            Storage::delete($customOrder->form_image);
                        }

                        $customOrder->delete();

                        return $this->ApiResponse(null, trans('local.option_not_found'), 404);
                    }
                } else {
                    $attribute_option = null;

                    if ($attribute_id->type == 'file') {
                        if ($request->file('attributes')) {

                            $file = $request->file('attributes')[$key]['image'];

                            $value = $this->filesServices->uploadfile($file, $this->customOrderDirectory);
                        } else {

                            if (isset($customOrder->piece_image)) {
                                Storage::delete($customOrder->piece_image);
                            }

                            if (isset($customOrder->form_image)) {
                                Storage::delete($customOrder->form_image);
                            }

                            $customOrder->delete();

                            return $this->ApiResponse(null, trans('local.file_required'), 404);
                        }
                    }
                }

                $customOrder->attributes()->create([
                    'attribute_id' => $attribute_id->id,
                    'option_id'    => $attribute_option ? $attribute_option->id : null,
                    'type'         => $attribute_id->type,
                    'value'        => $attribute_id->type == 'file' ? $value : ($attribute_id->type == 'text' ? $attribute['value'] : null),
                ]);
            }
        }

        foreach ($sellers as $seller) {
            MultiCustomOrder::create(['seller_id' => $seller->id, 'custom_order_id' => $customOrder->id, 'order_status_id' => $order_status_pending->id]);
            // Notification to seller
            $notification = Notification::create([
                'user_id'       => $seller->id,
                'type'          => 'custom_order',
                'model_id'      => $customOrder->id,
                'message_en'    => 'New order from ' . $user->name,
                'message_ar'    => 'طلب جديد من ' . $user->name,
            ]);

            Notify::NotifyMob($notification->message_ar, $notification->message_en, $seller->id, null, $data = null);
        }

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
        if ($priceOffer->isNotEmpty() || $customOrder->order_status->slug !==  'pending') {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        if (!isset($request->price)) {
            return $this->ApiResponse(null, trans('local.price_required'), 400);
        }

        $order_status_accepted = OrderStatus::where('slug', 'seller_accepted')->first();

        $customOrder->order_status_id = $order_status_accepted->id;
        $customOrder->save();

        MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $user->id)->update(['order_status_id' => $order_status_accepted->id]);

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $this->priceOfferRepository->create([
            'custom_order_id'   => $customOrder->id,
            'seller_id'         => $user->id,
            'price'             => $request->price,
            'status_id'         => $order_status_pending->id,
            'note'              => $request->note ?? null,
        ]);

        // Notification to user with price offer
        $notification = Notification::create([
            'user_id'       => $customOrder->user_id,
            'type'          => 'custom_order',
            'model_id'      => $customOrder->id,
            'message_en'    => 'Order from ' . $user->name . ' has been accepted',
            'message_ar'    => 'طلب من ' . $user->name . ' تم قبوله',
        ]);

        Notify::NotifyMob($notification->message_ar, $notification->message_en, $customOrder->user_id, null, $data = null);

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    /**
     * Step 2 if seller reject the order in this case the order will redirect automatic to another seller with same data in this seller
     */
    public function sellerRejectedOrder(Request $request, $id)
    {
        $user = auth()->user();

        $customOrder = $this->customOrderRepository->findOne($id);

        $seller_ids = MultiCustomOrder::where('custom_order_id', $id)->pluck('seller_id')->toArray();

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if (in_array($user->id, $seller_ids) == false) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $priceOffer = $this->priceOfferRepository->getWhere([['custom_order_id', $customOrder->id], ['seller_id', $user->id]]);

        if ($priceOffer->isNotEmpty()) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 403);
        }

        $rejected_status = OrderStatus::where('slug', 'seller_rejected')->first();

        MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $user->id)->update(['order_status_id' => $rejected_status->id]);

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (in_array($user->id, $rejectedOrder->toArray()) == false) {
            RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $user->id]);
        }

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (count($seller_ids) == count($rejectedOrder)) {
            RedirectOrderToAnotherUser($user->id, $rejectedOrder, $customOrder);
        }

        return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
    }

    /**
     * Step 3 => in case the seller accepted order and send price offer here user can take one of two actions [accept | reject] 
     */
    public function AcceptPriceOffer($id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        $customOrder = $this->customOrderRepository->findOne($priceOffer->custom_order_id);

        $accepted_status = OrderStatus::where('slug', 'accepted')->first();

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        if ($priceOffer->status_id == $accepted_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        $charge = generate_custom_order_payment_url($customOrder, $priceOffer, $user);

        $priceOffer->update(['status_id' => $accepted_status->id]);

        $priceOffer->save();

        $customOrder->update([
            'order_status_id'   => $accepted_status->id,
            'piece_price'       => $priceOffer->price,
            'seller_id'         => $priceOffer->seller_id
        ]);

        $customOrder->save();

        MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $priceOffer->seller_id)->update(['order_status_id' => $accepted_status->id]);

        return $this->ApiResponse($charge['transaction']['url'], trans('local.order_done'), 200);
    }

    public function RejectPriceOffer(Request $request, $id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        $customOrder = $this->customOrderRepository->findOne($priceOffer->custom_order_id);

        $seller_ids = MultiCustomOrder::where('custom_order_id', $priceOffer->custom_order_id)->pluck('seller_id')->toArray();

        $accepted_status = OrderStatus::where('slug', 'accepted')->first();

        $rejected_status = OrderStatus::where('slug', 'rejected')->first();

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        if ($priceOffer->status_id == $accepted_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        if ($priceOffer->status_id == $rejected_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_rejected'), 403);
        }

        $attributes = $request->all();

        MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $priceOffer->seller_id)->update(['order_status_id' => $rejected_status->id]);

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (in_array($priceOffer->seller_id, $rejectedOrder->toArray()) == false) {
            RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $priceOffer->seller_id]);
        }

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (count($seller_ids) == count($rejectedOrder)) {
            RedirectOrderToAnotherUser($priceOffer->seller_id, $rejectedOrder, $customOrder);
        }

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

        $multiOrder = MultiCustomOrder::where('custom_order_id', $id)->where('seller_id', $user->id)->first();

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id == $user->id) {
            return $this->ApiResponse(new CustomOrderDetailsResource($customOrder), null, 200);
        } elseif ($multiOrder->seller_id == $user->id) {
            return $this->ApiResponse(new CustomOrderDetailsResource($customOrder), null, 200);
        } else {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }
    }
}
