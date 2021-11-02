<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class ApiProductController extends Controller
{

    use ApiResponseTrait;
    protected $userRepository;
    protected $ProductRepository;

    public function __construct(UserRepositoryInterface $userRepository, ProductRepositoryInterface $productRepository)
    {

        $this->userRepository  = $userRepository;
        $this->productRepository  = $productRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->productRepository->getAll();

        return $this->ApiResponse($users, 'Retrive Data success', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->ApiResponse(null, $validator->errors(), 422);
        }

        $product = $this->productRepository->create($request->all());

        return $this->ApiResponse($product, 'Retrive Data success', 200);
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
        //
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
        //
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
}
