<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\ContactUsRepositoryInterface;
use Illuminate\Http\Request;

class ApiContactUs extends Controller
{

    use ApiResponseTrait;
    protected $contactUsRepository;


    public function __construct(ContactUsRepositoryInterface $contactUsRepository)
    {
        $this->contactUsRepository  = $contactUsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $message = $request->get('message');

        $form = $this->contactUsRepository->create(['name' => $name, 'email' => $email, 'message' => $message]);

        return $this->ApiResponse($form, null, 200);
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
