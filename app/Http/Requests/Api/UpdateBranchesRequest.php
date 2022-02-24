<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchesRequest extends MasterApiRequest
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
            // 'branches.*.region_id' => 'required|exists:regions,id',
            // 'branches.*.city_id' => 'required|exists:cities,id',
            // 'branches.*.phone' => 'required|numeric',
            // 'branches.*.address' => 'required|string',

        ];
    }

    public function messages()
    {
        return [
            'branches.*.region_id.required' => trans('errors.field_required', ['field' => trans('local.region')]),
            'branches.*.region_id.exists' => trans('errors.exists', ['attribute' => trans('local.region')]),
            'branches.*.city_id.required' => trans('errors.field_required', ['field' => trans('local.city')]),
            'branches.*.city_id.exists' => trans('errors.exists', ['attribute' => trans('local.city')]),
            'branches.*.phone.required' => trans('errors.phone_not_accept_minus'),
            'branches.*.phone.numeric' => trans('local.phone_required'),
            'branches.*.address.required' => trans('validation.required', ['attribute' => trans('local.address')]),
        ];
    }
}
