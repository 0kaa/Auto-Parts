<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class StoresResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $authorization_token = $request->headers->get('authorization');
        if ($authorization_token) {
            [$id, $token] = explode('|', $authorization_token, 2);
            $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $token))->first();
            $user_id = $token_data->tokenable_id;
            $user = User::find($user_id);
            $isFav =  $this->favourite()->where('user_id', $user->id)->exists();
        } else {
            $isFav = false;
        }
        return [
            'id'            => $this->id,
            'image'         => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            'cover'         => $this->activity_name && $this->activity_name->cover ?  url('/storage') . '/' . $this->activity_name->cover : url('/product-no-img.jpg'),
            'name'          => $this->name_company,
            'badge'         => $this->package ? url('/storage') . '/' . $this->package->badge : null,
            'rating'        => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0,
            'address'       => $this->address,
            'is_fav'        => $isFav,
            "lat"           => $this->lat,
            "lng"           => $this->lng,
            'activity_type' => $this->activity_name ? $this->activity_name->find($this->activity_type_id)->name : null,
        ];
    }
}
