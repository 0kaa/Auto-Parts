<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ShippingRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    private $shippingRepository;

    public function __construct(ShippingRepositoryInterface $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    public function index()
    {
        $shippings = $this->shippingRepository->getAll();
        return view('admin.shippings.index', compact('shippings'));
    }

    public function create()
    {
        return view('admin.shippings.create');
    }

    public function store(Request $request)
    {
        $this->shippingRepository->create($request->except('_method'));
        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.shippings')]), 200]);
    }

    public function edit($id)
    {
        $shipping = $this->shippingRepository->findWhere([['id', $id]]);
        return view('admin.shippings.edit', compact('shipping'));
    }

    public function update($id, Request $request)
    {
        $this->shippingRepository->update($request->except('_method'), $id);
        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.shippings')]), 200]);
    }
    public function destroy($id){
        $this->shippingRepository->delete($id);
        return  response()->json(['success' =>trans('local.deleted_success')
            ,'status'=> 200]);
    }
}
