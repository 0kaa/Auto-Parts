<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderServiceRequest extends FormRequest
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

                    'image' => 'required',


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

            'image.required' => __('errors.field_required', ['field' => __('admin.image')]),


        ];
    }
}
