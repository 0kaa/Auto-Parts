<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityType;
use App\Models\Car;
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
        dd($custom_orders);

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

        $cars = Car::get();

        $order_status = OrderStatus::whereIn('slug', ['processing', 'completed', 'cancelled'])->get();

        $activities = ActivityType::get();

        $sub_activities = SubActivity::where('activity_type_id', $order->activity_type_id)->where('parent_id', null)->get();

        $sub_sub_activities = SubActivity::where('activity_type_id', 6)->where('parent_id', $order->sub_activity_id)->get();

        return view('admin.custom-orders.edit', \compact('order', 'shippings', 'payments', 'order_status', 'activities', 'sub_activities', 'sub_sub_activities', 'cars'));
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

        $piece_image = $custom_order->piece_image;

        if ($request->hasFile('piece_image')) {
            Storage::delete($custom_order->piece_image);

            $img = $request->file('piece_image');
            $piece_image = $this->filesServices->uploadfile($img, 'custom_order');
        }

        $form_image = $custom_order->form_image;

        if ($request->hasFile('form_image')) {
            Storage::delete($custom_order->form_image);

            $img = $request->file('form_image');
            $form_image = $this->filesServices->uploadfile($img, 'custom_order');
        }

        $this->customOrderRepository->update(array_merge($request->except('_method', 'image'), ['piece_image' => $piece_image, 'form_image' => $form_image]), $id);
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
}
