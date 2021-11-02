<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompanyRequest extends FormRequest
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
    public function rules(Request $request)
    {

        $userrepository = \App::make('App\Repositories\UserRepositoryInterface');

        $user = $userrepository->findOne($request->user_id);

        if($user->approved == 1)
        {
            
            return [
    
                'user_id'                                    => 'required',
                'name_company'                               => 'required',
                'name_owner_company'                         => 'required',
                'national_identity'                          => 'required',
                'date'                                       => 'required',
                'file'                                       => 'required|mimes:jpg,png,jpeg,gif',
                'ibn'                                        => 'required',
                'city'                                       => 'required',
                'is_company_facility_agent'                  => 'required',
                'is_company_facility_authorized_distributor' => 'required',
                'company_sector_id'                          => 'required',
                'other_branches'                             => 'required',
                'region_id'                                  => 'required',
                'activity_type_id'                           => 'required',
    
            ];

        } else 
        {

            return [

                'no_active' => 'required'

            ];

        }

    }
}
