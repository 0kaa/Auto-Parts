<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
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

    public function create(ContactRequest $request)
    {
        try {

            $form = $this->contactUsRepository->create(['name' => $request->name, 'email' => $request->email, 'message' => $request->message]);

            return $this->ApiResponse($form, trans('local.contact_success'), 200);
        } catch (\Exception $e) {
            return $this->ApiResponse(null, $e->getMessage(), 400);
        }
    }
}
