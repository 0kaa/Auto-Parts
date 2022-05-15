<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendWalletRequest;
use App\Models\WalletRequest;
use Illuminate\Http\Request;

class ApiWalletRequestController extends Controller
{
    use ApiResponseTrait;

    // create wallet request
    public function createWalletRequest(SendWalletRequest $request)
    {
        $data = $request->all;

        $data['user_id'] = auth()->user()->id;

        $walletRequest = WalletRequest::create($data);

        return $this->ApiResponse(new ActivityResource($walletRequest), null, 200);
    }
}
