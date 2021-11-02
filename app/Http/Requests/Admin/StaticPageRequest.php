<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaticPageRequest extends FormRequest
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
            //
            'desc_ar'=>'required',
            'desc_en'=>'required'
        ];
    }


    public function messages()
    {
        return [

            'desc_ar.required' => __('errors.field_required', ['field' => __('admin.content_ar')]),
            'desc_en.required' =>  __('errors.field_required', ['field' => __('admin.content_en')]),


        ];
    }
}
