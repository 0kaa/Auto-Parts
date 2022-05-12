<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomOrderItemRequest extends FormRequest
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
            'piece_name' => 'required',
            'piece_image' => 'nullable',
            'piece_price' => 'required',
            'piece_description' => 'sometimes',
            'form_image' => 'nullable',
            'note' => 'nullable',
            'quantity' => 'required',
            'car_id' => 'required',
            'car_model_id' => 'required',
            'activity_type_id' => 'required',
            'sub_activity_id' => 'required',
            'sub_sub_activity_id' => 'sometimes',
        ];
    }
}
