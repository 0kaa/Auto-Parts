<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\UploadFilesServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $filesServices;

    private $imageDirectory = 'images';

    public function __construct(UploadFilesServices $filesServices)
    {
        $this->filesServices = $filesServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = User::role('owner_store')->get();

        return view('admin.products.create' , compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->imageDirectory);
        }
        $features = [];

        if ($request->featuresarray) {
            foreach (explode(',', $request->featuresarray) as $key => $feature) {
                $features[$key]['text'] = $feature;
            }
        }

        $details = [];

        if ($request->detailsarray) {
            foreach (explode(',', $request->detailsarray) as $key => $detail) {
                $details[$key]['text'] = $detail;
            }
        }

        Product::create(array_merge($request->except('image', 'featuresarray', 'detailsarray'), ['image' => $image, "features" => $features, "details" => $details]));

        return  response()->json(['success' => trans('admin.added_success', ['field' => __('local.product')]), 200]);
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
        $product = Product::find($id);
        $sellers = User::role('owner_store')->get();

        return view('admin.products.edit', compact('product', 'sellers'));
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
        // dd($request->all());

        $product = Product::find($id);


        $image = $product->image;

        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $img = $request->file('image');
            $image = $this->filesServices->uploadfile($img, $this->imageDirectory);
        }

        $features = [];
        if ($request->featuresarray) {
            foreach (explode(',', $request->featuresarray) as $key => $feature) {
                $features[$key]['text'] = $feature;
            }
        }

        $details = [];
        if ($request->detailsarray) {
            foreach (explode(',', $request->detailsarray) as $key => $detail) {
                $details[$key]['text'] = $detail;
            }
        }

        $product->update(array_merge($request->except('_method', 'image', 'featuresarray', 'detailsarray'), ['image' => $image, "features" => $features, "details" => $details]));

        return  response()->json(['success' => trans('admin.updated_success', ['field' => __('local.product')]), 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (isset($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete($id);
        return  response()->json([
            'success' => trans('local.deleted_success'), 'status' => 200
        ]);
    }
}
