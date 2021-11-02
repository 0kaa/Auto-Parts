<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
                    'name_ar' => 'required|min:2',
                    'name_en' => 'required|min:2',


                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [


                    'name_ar' => 'required|min:2',
                    'name_en' => 'required|min:2',



                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('errors.field_required', ['field' => trans('local.name_ar')]),
            'name_ar.min' => __('errors.min', ['field' => __('local.name_ar'),'value'=>2]),
            'name_en.required' => trans('errors.field_required', ['field' => trans('local.name_en')]),
            'name_en.min' => __('errors.min', ['field' => __('local.name_en'),'value'=>2]),

        ];
    }
}
