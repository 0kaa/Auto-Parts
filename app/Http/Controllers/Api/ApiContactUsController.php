<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Repositories\ContactUsRepositoryInterface;
use Illuminate\Http\Request;

class ApiContactUsController extends Controller
{

    use ApiResponseTrait;
    protected $contactUsRepository;


    public function __construct(ContactUsRepositoryInterface $contactUsRepository)
    {
        $this->contactUsRepository  = $contactUsRepository;
    }

    public function create(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $form = $this->contactUsRepository->create(['name' => $name, 'email' => $email, 'message' => $message]);

        return $this->ApiResponse($form, null, 200);
    }

}
