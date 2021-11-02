<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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

            'email'  => 'required|email|unique:subscribe,email',

        ];
    }


    public function messages()
    {
        return [

            'email.required' => __('errors.field_required', ['field' => __('local.email')]),
            'email.email' => __('errors.email_valid'),
            'email.unique' => __('errors.unique', ['field' => __('local.email')]),


        ];
    }
}
