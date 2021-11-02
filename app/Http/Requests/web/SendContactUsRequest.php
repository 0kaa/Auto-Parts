<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class SendContactUsRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|min:2',
                    'email'  => 'required|email',
                    'message' => 'required|min:2',


                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [


                ];
            }
            default:break;
        }
    }


    public function messages()
    {
        return [

            'name.required' => __('errors.field_required', ['field' => __('local.name')]),
            'name.min' => __('errors.min', ['field' => __('local.name'),'value'=>2]),
            'email.required' => __('errors.field_required', ['field' => __('local.email')]),
            'email.email' => __('errors.email_valid'),
            'message.required' => __('errors.field_required', ['field' => __('local.message')]),
            'message.min' => __('errors.min', ['field' => __('local.message'),'value'=>2]),


        ];
    }
}
