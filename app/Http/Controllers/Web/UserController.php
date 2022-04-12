<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ActiveCodeRequest;
use App\Http\Requests\Web\CompanyRequest;
use App\Http\Requests\Web\RegisterRequest;
use App\Repositories\ActivityTypeRepositoryInterface;
use App\Repositories\CompanySectorRepositoryInterface;
use App\Repositories\RegionRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $userrepository;
    protected $activityrepository;
    protected $regionrepository;
    protected $comapnyrepository;

    public function __construct(
        UserRepositoryInterface $userrepository,
        ActivityTypeRepositoryInterface $activityrepository,
        RegionRepositoryInterface $regionrepository,
        CityRepositoryInterface $cityrepository,
        CompanySectorRepositoryInterface $comapnyrepository
    ) {

        $this->userrepository     = $userrepository;
        $this->activityrepository = $activityrepository;
        $this->regionrepository   = $regionrepository;
        $this->cityrepository     = $cityrepository;
        $this->comapnyrepository  = $comapnyrepository;
    } // end of construct

    public function register()
    {

        $activities_types =  $this->activityrepository->getAll();

        return view('website.register', compact('activities_types'));
    } // end of register

    public function registerStore(RegisterRequest $request)
    {

        $attribute = $request->except('password', 'confirm_password');

        $attribute['verification_code'] = rand(1111, 9999);
        $attribute['approved'] = 0;
        $attribute['image'] = 'users/avatar.png';
        $attribute['password'] = bcrypt($request->password);

        $user = $this->userrepository->create($attribute);

        if ($user) {
            $user->assignRole('owner_store');
            send_activation_code($user->verification_code, $user->phone);
            return response()->json(['data' => 1, 'user_id' => $user->id, 'phone' => $user->phone]);
        } else {
            return response()->json(['data' => 0, 'error' =>  trans('local.error_register')]);
        }
    }  // end of register store

    public function companyStore(CompanyRequest $request)
    {

        // dd($request->all());

        $attribute = $request->except('file', 'addressarray', 'phonearray', 'areaarray', 'cityarray');

        $user = $this->userrepository->findOne($request->user_id);

        // uploade one file
        if ($request->has('file')) {

            // Upload new file
            $attribute['file'] = $request->file('file')->store('company');
        } // end of has image   

        $userUpdate = $user->update($attribute);

        if ($userUpdate) {
            if ($request->addressarray) {
                foreach (explode(',', $request->addressarray) as $key => $address) {

                    $user->branches()->create([
                        'address'   => $address,
                        'city_id'   => explode(',', $request->cityarray)[$key],
                        'region_id' => explode(',', $request->areaarray)[$key],
                        'phone'     => explode(',', $request->phonearray)[$key],
                    ]);
                }
            }

            return response()->json(['data' => 1]);
        } else {

            return response()->json(['data' => 0, 'error' => trans('local.error_comapny')]);
        }
    }  // end of company store

    public function activeStore(ActiveCodeRequest $request)
    {

        $code = $this->userrepository->getWhere([['verification_code', $request->code], ['phone', $request->phone_active]])->first();

        if ($code) {

            $code->update([

                'approved' => 1,
                'verification_code' => null,

            ]);

            return response()->json(['data' => 1]);
        } else {

            return response()->json(['data' => 0, 'error' => trans('local.error_code')]);
        }
    }  // end of active store

    public function getActivitiesType(Request $request)
    {
        $activities_type    = $this->activityrepository->getWhere(['type' => $request->type])->first();
        $areas              = $this->regionrepository->getAll();
        $cities             = $this->cityrepository->getAll();
        $comapnies          = $this->comapnyrepository->getAll();

        return view('website.get_activity_type', compact('activities_type', 'areas', 'cities', 'comapnies'))->render();
    }  // end of get activate

    public function getBranches(Request $request)
    {

        $areas              = $this->regionrepository->getAll();
        $cities             = $this->cityrepository->getAll();

        return response()->json(['areas' => $areas, 'cities' => $cities]);
    }  // end of get getBranches

    public function resendCode(Request $request)
    {

        $user = $this->userrepository->getWhere(['phone' => $request->phone])->first();

        $code = rand(1111, 9999);

        $user->update([
            'verification_code' => $code
        ]);

        return response()->json(['success' => trans('local.resned_code_success')]);
    }  // end of resendCode



}
