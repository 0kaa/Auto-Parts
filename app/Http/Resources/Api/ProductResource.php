<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price . ' SAR',
            'is_fav' => $isFav,
            'image' => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            'rating' => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0
        ];
    }
}
