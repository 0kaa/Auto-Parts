<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_ship_address'    => 'required',
            'order_ship_name'       => 'required',
            'order_ship_phone'      => 'required',
            'seller_id'             => 'required',
            'products'              => 'required|array|min:1',
            'products.*.id'         => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:1',
            'shipping_id'           => 'required|exists:shippings,id',
        ];
    }
}