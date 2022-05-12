<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomOrderItemRequest;
use App\Models\ActivityType;
use App\Models\Car;
use App\Models\CompanyModel;
use App\Models\CompanySector;
use App\Models\CustomOrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Shipping;
use App\Models\SubActivity;
use App\Repositories\CustomOrderRepositoryInterface;
use App\Services\UploadFilesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomOrderController extends Controller
{
    protected $customOrderRepository;
    protected $filesServices;


    public function __construct(CustomOrderRepositoryInterface $customOrderRepository,  UploadFilesServices $filesServices)
    {
        $this->customOrderRepository = $customOrderRepository;
        $this->filesServices = $filesServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custom_orders = $this->customOrderRepository->getAll();

        return view('admin.custom-orders.index', compact('custom_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->customOrderRepository->findOne($id);

        $shippings = Shipping::get();

        $payments = PaymentMethod::get();

        $cars = CompanySector::get();

        $order_status = OrderStatus::whereIn('slug', ['processing', 'completed', 'paid', 'cancelled'])->get();

        $activities = ActivityType::get();

        $sub_activities = SubActivity::where('activity_type_id', $order->activity_type_id)->where('parent_id', null)->get();

        $sub_sub_activities = SubActivity::where('activity_type_id', 6)->where('parent_id', $order->sub_activity_id)->get();


        $custom_order_items = CustomOrderItem::where('custom_order_id', $order->id)->get();

        return view('admin.custom-orders.edit', \compact('order', 'shippings', 'payments', 'order_status', 'activities', 'sub_activities', 'sub_sub_activities', 'cars', 'custom_order_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $custom_order = $this->customOrderRepository->findOne($id);

        $this->customOrderRepository->update(array_merge($request->except('_method')), $id);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.custom_orders')]), 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_activity(Request $request)
    {
        $sub_activities = SubActivity::where('activity_type_id', $request->id)->where('parent_id', null)->get();

        return view('admin.custom-orders.sub_activity', compact('sub_activities'))->render();
    }

    public function get_sub_activity(Request $request)
    {
        $sub_sub_activities = SubActivity::where('parent_id', $request->id)->get();

        return view('admin.custom-orders.sub_sub_activity', compact('sub_sub_activities'))->render();
    }

    // edit custom order item
    public function edit_custom_order_item(Request $request)
    {
        $order = CustomOrderItem::find($request->id);

        $cars = CompanySector::get();

        $order_status = OrderStatus::whereIn('slug', ['processing', 'completed', 'paid', 'cancelled'])->get();

        $activities = ActivityType::get();

        $sub_activities = SubActivity::where('activity_type_id', $order->activity_type_id)->where('parent_id', null)->get();

        $sub_sub_activities = SubActivity::where('activity_type_id', 6)->where('parent_id', $order->sub_activity_id)->get();

        $car_models = CompanyModel::where('company_sector_id', $order->car_model_id)->get();

        return view('admin.custom-order-items.edit', compact('order' ,'cars', 'order_status', 'activities', 'sub_activities', 'sub_sub_activities', 'car_models'));
    }

    // update custom order item
    public function update_custom_order_item(CustomOrderItemRequest $request, $id)
    {
        // dd($request->all());

        $custom_order_item = CustomOrderItem::find($id);;

        $data = $request->except('_method', '_token', 'piece_image', 'form_image');

        if ($request->hasFile('piece_image')) {
            Storage::delete($custom_order_item->piece_image);

            $data['piece_image'] = $request->file('piece_image')->store('custom_order');

        } else {
            $data['piece_image'] = $custom_order_item->piece_image;
        }

        if ($request->hasFile('form_image')) {
            Storage::delete($custom_order_item->form_image);

            $data['form_image'] = $request->file('form_image')->store('custom_order');

        } else {
            $data['form_image'] = $custom_order_item->form_image;
        }

        $custom_order_item->update($data);

        return \redirect()->back()->with('success', __('admin.updated_success'));
    }

    // get car model
    public function get_car_model(Request $request)
    {
        $car_models = CompanyModel::where('company_sector_id', $request->id)->get();

        return view('admin.custom-order-items.car_model', compact('car_models'))->render();
    }
}
