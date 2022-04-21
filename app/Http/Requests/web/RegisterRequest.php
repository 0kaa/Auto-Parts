<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name'       => 'required|string|min:3',
            'last_name'        => 'required|string|min:3',
            'username'         => 'required|string|min:3|unique:users,username',
            'email'            => 'required|unique:users,email',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
            'phone'            => 'required|unique:users,phone',

        ];
    }
}
