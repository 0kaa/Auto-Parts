<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Repositories\CustomOrderRepositoryInterface;

class ApiCustomOrderController extends Controller
{
    use ApiResponseTrait;
    private $customOrderRepository;

    public function __construct(CustomOrderRepositoryInterface $customOrderRepository)
    {
        $this->customOrderRepository = $customOrderRepository;
    }

    public function CreateCustomOrder(Request $request)
    {
        $user = auth()->user();
        $attrubites = $request->all();
        $customOrder = $this->customOrderRepository->create([
            'user_id'           => $user->id,
            'seller_id'         => $attrubites['seller_id'],
            'activity_type_id'  => $attrubites['activity_type_id'],
            'sup_activity_id'   => $attrubites['sup_activity_id'],
            'order_data'        => $attrubites['order_data']
        ]);

        return $this->ApiResponse($customOrder);
    }
}
