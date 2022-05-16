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
        // $attributes     = $request->all();
        $orderItems     = $request->order_items;

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $customOrder =  $this->customOrderRepository->create([
            'seller_id'             => $request->seller_id,
            'user_id'               => $user->id,
            'shipping_id'           => $request->shipping_id,
            'payment_id'            => $request->payment_id,
            'order_status_id'       => $order_status_pending->id,
        ]);

        foreach ($orderItems as $key => $orderItem) {

            $piece_image    = '';
            $form_image     = '';

            $activity       = $this->activityTypeRepository->findOne($orderItem['activity_type_id']);

            if (!$activity) {
                return $this->ApiResponse(null, trans('local.activity_id_not_found'), 404);
            }

            $sub_activity       = $activity->sub_activity()->where('id', $orderItem['sub_activity_id'])->first();
            $sub_sub_activity   = null;

            if (!$sub_activity) {
                return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
            }

            if ($activity->id == 6) {
                if (array_key_exists('sub_sub_activity_id', $orderItem)) {
                    $sub_sub_activity = $activity->sub_activity()->where('id', $orderItem['sub_sub_activity_id'])->where('parent_id', $sub_activity->id)->first();
                    if (!$sub_sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
                } else {
                    return $this->ApiResponse(null, trans('local.sub_sub_activity_required'), 404);
                }
            }

            if ($request->file('order_items') && array_key_exists('piece_image', $orderItem)) {
                $img = $request->file('order_items')[$key]['piece_image'];
                $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
            }

            if ($request->file('order_items')  && array_key_exists('form_image', $orderItem)) {
                $form_img = $request->file('order_items')[$key]['form_image'];
                $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
            }

            $custom_order_item =  $customOrder->custom_order_items()->create([
                "piece_name"            => $orderItem['piece_name'],
                "piece_image"           => $piece_image,
                'note'                  => $orderItem['note'],
                'form_image'            => $form_image,
                "car_id"                => $orderItem['car_id'],
                "car_model_id"          => $orderItem['car_model_id'],
                'quantity'              => array_key_exists('quantity', $orderItem) ? $orderItem['quantity'] : 1,
                'activity_type_id'      => $activity->id,
                'sub_activity_id'       => $sub_activity->id,
                'sub_sub_activity_id'   => $sub_sub_activity ? $sub_sub_activity->id : null,
            ]);


            if (array_key_exists('attributes', $orderItem)) {
                foreach ($orderItem['attributes'] as $key => $attribute) {

                    $attribute_id   = $this->attributeRepository->findOne($attribute['attribute_id']);

                    if (!$attribute_id) {

                        if (isset($custom_order_item->piece_image)) {
                            Storage::delete($custom_order_item->piece_image);
                        }

                        if (isset($custom_order_item->form_image)) {
                            Storage::delete($custom_order_item->form_image);
                        }

                        $custom_order_item->delete();

                        return $this->ApiResponse(null, trans('local.attribute_not_found'), 404);
                    }

                    if ($attribute_id->type == 'select') {
                        $attribute_option = $attribute_id->options->where('id', $attribute['option_id'])->first();

                        if (!$attribute_option) {

                            if (isset($custom_order_item->piece_image)) {
                                Storage::delete($custom_order_item->piece_image);
                            }

                            if (isset($custom_order_item->form_image)) {
                                Storage::delete($custom_order_item->form_image);
                            }

                            $custom_order_item->delete();

                            return $this->ApiResponse(null, trans('local.option_not_found'), 404);
                        }
                    } else {
                        $attribute_option = null;

                        if ($attribute_id->type == 'file') {
                            if ($request->file('attributes')) {

                                $file = $request->file('attributes')[$key]['image'];

                                $value = $this->filesServices->uploadfile($file, $this->customOrderDirectory);
                            } else {

                                if (isset($custom_order_item->piece_image)) {
                                    Storage::delete($custom_order_item->piece_image);
                                }

                                if (isset($custom_order_item->form_image)) {
                                    Storage::delete($custom_order_item->form_image);
                                }

                                $custom_order_item->delete();

                                return $this->ApiResponse(null, trans('local.file_required'), 404);
                            }
                        }
                    }

                    $custom_order_item->attributes()->create([
                        'attribute_id' => $attribute_id->id,
                        'option_id'    => $attribute_option ? $attribute_option->id : null,
                        'type'         => $attribute_id->type,
                        'value'        => $attribute_id->type == 'file' ? $value : ($attribute_id->type !== 'select' ? $attribute['value'] : null),
                    ]);
                }
            }
        }

        MultiCustomOrder::create([
            'seller_id' => $request->seller_id,
            'custom_order_id' => $customOrder->id,
            'order_status_id' => $order_status_pending->id
        ]);

        // Notification to seller
        $notification = Notification::create([
            'user_id'       => $request->seller_id,
            'type'          => 'custom_order',
            'model_id'      => $customOrder->id,
            'message_en'    => 'New special order from ' . $user->name,
            'message_ar'    => 'طلب خاص جديد من ' . $user->name,
        ]);

        Notify::NotifyMob($notification->message_ar, $notification->message_en, $request->seller_id, null, $data = null);

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    public function CreateMultiCustomOrder(Request $request)
    {
        $user           = auth()->user();
        // $attributes     = $request->all();
        $orderItems     = $request->order_items;

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $customOrder =  $this->customOrderRepository->create([
            'user_id'               => $user->id,
            'shipping_id'           => $request->shipping_id,
            'payment_id'            => $request->payment_id,
            'order_status_id'       => $order_status_pending->id,
        ]);

        foreach ($orderItems as $key => $orderItem) {

            $piece_image    = '';
            $form_image     = '';

            $activity       = $this->activityTypeRepository->findOne($orderItem['activity_type_id']);

            if (!$activity) {
                return $this->ApiResponse(null, trans('local.activity_id_not_found'), 404);
            }

            $sub_activity       = $activity->sub_activity()->where('id', $orderItem['sub_activity_id'])->first();
            $sub_sub_activity   = null;

            if (!$sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);

            if ($activity->id == 6) {
                if (array_key_exists('sub_sub_activity_id', $orderItem)) {
                    $sub_sub_activity = $activity->sub_activity()->where('id', $orderItem['sub_sub_activity_id'])->where('parent_id', $sub_activity->id)->first();
                    if (!$sub_sub_activity) return $this->ApiResponse(null, trans('local.sub_activity_notfound'), 404);
                } else {
                    return $this->ApiResponse(null, trans('local.sub_sub_activity_required'), 404);
                }
            }

            $sellers = User::whereRelation('roles', 'name', 'owner_store')->where('activity_type_id', $orderItem['activity_type_id'])->limit(5)->get();

            if ($sellers->count() == 0) return $this->ApiResponse(null, trans('local.sellers_not_founded_in_this_activity'), 404);
            if ($request->file('order_items') && array_key_exists('piece_image', $orderItem)) {
                $img = $request->file('order_items')[$key]['piece_image'];
                $piece_image = $this->filesServices->uploadfile($img, $this->customOrderDirectory);
            }
            if ($request->file('order_items') && array_key_exists('form_image', $orderItem)) {
                $form_img = $request->file('order_items')[$key]['form_image'];
                $form_image = $this->filesServices->uploadfile($form_img, $this->customOrderDirectory);
            }

            $custom_order_item =  $customOrder->custom_order_items()->create([
                "piece_name"            => $orderItem['piece_name'],
                "piece_image"           => $piece_image,
                'note'                  => $orderItem['note'],
                'form_image'            => $form_image,
                "car_id"                => $orderItem['car_id'],
                "car_model_id"          => $orderItem['car_model_id'],
                'quantity'              => array_key_exists('quantity', $orderItem) ? $orderItem['quantity'] : 1,
                'activity_type_id'      => $activity->id,
                'sub_activity_id'       => $sub_activity->id,
                'sub_sub_activity_id'   => $sub_sub_activity ? $sub_sub_activity->id : null,
            ]);

            if (array_key_exists('attributes', $orderItem)) {
                foreach ($orderItem['attributes'] as $key => $attribute) {

                    $attribute_id   = $this->attributeRepository->findOne($attribute['attribute_id']);

                    if (!$attribute_id) {

                        if (isset($custom_order_item->piece_image)) {
                            Storage::delete($custom_order_item->piece_image);
                        }

                        if (isset($custom_order_item->form_image)) {
                            Storage::delete($custom_order_item->form_image);
                        }

                        $custom_order_item->delete();

                        return $this->ApiResponse(null, trans('local.attribute_not_found'), 404);
                    }

                    if ($attribute_id->type == 'select') {
                        $attribute_option = $attribute_id->options->where('id', $attribute['option_id'])->first();

                        if (!$attribute_option) {

                            if (isset($custom_order_item->piece_image)) {
                                Storage::delete($custom_order_item->piece_image);
                            }

                            if (isset($custom_order_item->form_image)) {
                                Storage::delete($custom_order_item->form_image);
                            }

                            $custom_order_item->delete();

                            return $this->ApiResponse(null, trans('local.option_not_found'), 404);
                        }
                    } else {
                        $attribute_option = null;

                        if ($attribute_id->type == 'file') {
                            if ($request->file('attributes')) {

                                $file = $request->file('attributes')[$key]['image'];

                                $value = $this->filesServices->uploadfile($file, $this->customOrderDirectory);
                            } else {

                                if (isset($custom_order_item->piece_image)) {
                                    Storage::delete($custom_order_item->piece_image);
                                }

                                if (isset($custom_order_item->form_image)) {
                                    Storage::delete($custom_order_item->form_image);
                                }

                                $custom_order_item->delete();

                                return $this->ApiResponse(null, trans('local.file_required'), 404);
                            }
                        }
                    }

                    $custom_order_item->attributes()->create([
                        'attribute_id' => $attribute_id->id,
                        'option_id'    => $attribute_option ? $attribute_option->id : null,
                        'type'         => $attribute_id->type,
                        'value'        => $attribute_id->type == 'file' ? $value : ($attribute_id->type !== 'select' ? $attribute['value'] : null),
                    ]);
                }
            }
        }

        foreach ($sellers as $seller) {
            MultiCustomOrder::create(['seller_id' => $seller->id, 'custom_order_id' => $customOrder->id, 'order_status_id' => $order_status_pending->id]);
            // Notification to seller
            $notification = Notification::create([
                'user_id'       => $seller->id,
                'type'          => 'custom_order',
                'model_id'      => $customOrder->id,
                'message_en'    => 'New special order from ' . $user->name,
                'message_ar'    => 'طلب خاص جديد من ' . $user->name,
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

        $multiOrderExist = MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $user->id)->first();

        if ($multiOrderExist->order_status->slug == 'rejected') {
            return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
        }

        $customOrderItems = $customOrder->custom_order_items;

        $offers = $request->offers;

        if (count($offers) != count($customOrderItems)) {
            return $this->ApiResponse(null, trans('local.please_send_all_offer'), 400);
        }

        $order_status_pending = OrderStatus::where('slug', 'pending')->first();

        $totalPriceOffer = 0;

        $findPriceOfferExist = $this->priceOfferRepository->findWhere(['custom_order_id' => $customOrder->id, 'seller_id' => $user->id]);
        if ($findPriceOfferExist) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 200);
        }

        $newPriceOffer = $this->priceOfferRepository->create([
            'custom_order_id'       => $customOrder->id,
            'seller_id'             => $user->id,
            'price'                 => 0,
            'status_id'             => $order_status_pending->id,
        ]);

        foreach ($offers as $key => $offer) {

            if ($customOrder->order_status->slug !==  'pending') {
                return $this->ApiResponse(null, trans('local.order_already_accepted'), 200);
            }

            if (!isset($offer['price'])) {
                return $this->ApiResponse(null, trans('local.price_required'), 400);
            }

            $newPriceOffer->priceOfferItems()->create([
                'price_offer_id'        => $newPriceOffer->id,
                'custom_order_item_id'  => $offer['id'],
                'price'                 => $offer['price'],
                'quantity'              => $offer['quantity'] ?? 1,
            ]);


            $totalPriceOffer += $offer['price'];

            $newPriceOffer->price = $totalPriceOffer;
            $newPriceOffer->save();
        }

        // Notification to user with price offer
        $notification = Notification::create([
            'user_id'       => $customOrder->user_id,
            'type'          => 'price_offer',
            'model_id'      => $customOrder->id,
            'message_en'    => 'Price offer from ' . $user->name_company . ' for order #' . $customOrder->id . ' is ' . $totalPriceOffer . ' SAR',
            'message_ar'    => 'عرض السعر من ' . $user->name_company . ' للطلب #' . $customOrder->id . ' هو ' . $totalPriceOffer . ' ر.س',
        ]);

        Notify::NotifyMob($notification->message_ar, $notification->message_en, $customOrder->user_id, null, $data = null);

        return $this->ApiResponse(null, trans('local.order_done'), 200);
    }

    /**
     * Step 2 if seller reject the order in this case the order will redirect automatic to another seller with same data in this seller
     */
    public function sellerRejectedOrder($id)
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

        $priceOffer = $this->priceOfferRepository->findWhere(['custom_order_id' => $customOrder->id, 'seller_id' => $user->id]);

        $accepted_status = OrderStatus::where('slug', 'accepted')->first();

        $rejected_status = OrderStatus::where('slug', 'rejected')->first();

        if ($priceOffer) {
            if ($priceOffer->status_id == $accepted_status->id || $customOrder->order_status_id == $accepted_status->id) {
                return $this->ApiResponse(null, trans('local.order_already_accepted'), 200);
            }

            if ($priceOffer->status_id == $rejected_status->id || $customOrder->order_status_id == $rejected_status->id) {
                return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
            }

            return $this->ApiResponse(null, trans('local.order_not_found'), 200);
        } else {

            MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $user->id)->update(['order_status_id' => $rejected_status->id]);

            $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

            if (in_array($user->id, $rejectedOrder->toArray()) == false) {
                RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $user->id]);
            }

            $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

            if (count($seller_ids) == count($rejectedOrder)) {
                RedirectOrderToAnotherUser($user->id, $rejectedOrder, $customOrder);
            }

            return $this->ApiResponse(null, trans('local.order_rejected'), 200);
        }
    }

    /**
     * Step 3 => in case the seller accepted order and send price offer here user can take one of two actions [accept | reject] 
     */
    public function AcceptPriceOffer($id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        $customOrder = $priceOffer->customOrder;

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        $accepted_status = OrderStatus::where('slug', 'accepted')->first();
        $rejected_status = OrderStatus::where('slug', 'rejected')->first();

        if ($priceOffer->status_id == $accepted_status->id || $customOrder->order_status_id == $accepted_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }

        if ($priceOffer->status_id == $rejected_status->id || $customOrder->order_status_id == $rejected_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_rejected'), 403);
        }

        $charge = generate_custom_order_payment_url($customOrder, $user, $priceOffer);

        if ($charge) {

            $priceOffer->update(['status_id' => $accepted_status->id]);

            $customOrder->update([
                'order_status_id'   => $accepted_status->id,
                'price'             => $priceOffer->price,
                'seller_id'         => $priceOffer->seller_id,
            ]);

            MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $customOrder->seller_id)->update(['order_status_id' => $accepted_status->id]);

            return $this->ApiResponse($charge['transaction']['url'], trans('local.order_done'), 200);
        } else {
            return $this->ApiResponse('', 'Payment failed', 403);
        }
    }

    public function RejectPriceOffer($id)
    {
        $user = auth()->user();

        $priceOffer = $this->priceOfferRepository->findOne($id);

        if (!$priceOffer) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        $customOrder = $priceOffer->customOrder;

        if (!$customOrder) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 404);
        }

        $seller_ids = MultiCustomOrder::where('custom_order_id', $customOrder->id)->pluck('seller_id')->toArray();

        $accepted_status = OrderStatus::where('slug', 'accepted')->first();

        $rejected_status = OrderStatus::where('slug', 'rejected')->first();

        $notfound_status = OrderStatus::where('slug', 'not_found')->first();

        if ($customOrder->user_id != $user->id) {
            return $this->ApiResponse(null, trans('local.order_not_allowed_update'), 403);
        }

        if ($customOrder->order_status_id == $accepted_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_accepted'), 403);
        }
        if ($customOrder->order_status_id == $rejected_status->id) {
            return $this->ApiResponse(null, trans('local.order_already_rejected'), 403);
        }
        if ($customOrder->order_status_id == $notfound_status->id) {
            return $this->ApiResponse(null, trans('local.order_not_found'), 403);
        }

        $seller_id = $priceOffer->seller_id;

        $priceOffer->update(['status_id' => $rejected_status->id]);

        MultiCustomOrder::where('custom_order_id', $customOrder->id)->where('seller_id', $seller_id)->update(['order_status_id' => $rejected_status->id]);

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (in_array($seller_id, $rejectedOrder->toArray()) == false) {
            RejectedOrders::create(['order_id' => $customOrder->id, 'seller_id' => $seller_id]);
        }

        $rejectedOrder = RejectedOrders::where('order_id', $customOrder->id)->pluck('seller_id');

        if (count($seller_ids) == count($rejectedOrder)) {
            RedirectOrderToAnotherUser($seller_id, $rejectedOrder, $customOrder);
        }

        return $this->ApiResponse(null, trans('local.order_already_rejected'), 200);
    }


    public function PriceOffers($id)
    {
        $priceOffers = $this->priceOfferRepository->getWhere([['custom_order_id', $id]], ['column' => 'created_at', 'dir' => 'DESC']);

        return $this->ApiResponse(PriceOffersResource::collection($priceOffers), null, 200);
    }

    public function userOrders()
    {
        $user = auth()->user();

        $customOrders = $this->customOrderRepository->getWhere([['user_id', $user->id]]);

        return $this->ApiResponse(CustomOrderListResource::collection($customOrders), null, 200);
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
