<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;

class ProductDetailResource extends JsonResource
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
            'image' => $this->image ? url('/storage') . '/' . $this->image : url('/product-no-img.jpg'),
            'price' => $this->price . ' SAR',
            'description' => $this->description,
            'rating' => $this->ratings()->avg('rating') ? $this->ratings()->avg('rating') : 0,
            'comments_count' => count($this->ratings),
            'seller_id' => $this->seller->id,
            'seller_name' => $this->seller->name_owner_company,
            'seller_rating' => $this->seller->ratings()->avg('rating') ? $this->seller->ratings()->avg('rating') : 0,
            'seller_image' => $this->seller->image ? url('/storage') . '/' . $this->seller->image : url('/product-no-img.jpg'),
            'seller_tokens' => $this->seller->firebase_tokens->pluck('firebase_token')->toArray(),
            'user_tokens' =>  $authorization_token ? $user->firebase_tokens->pluck('firebase_token')->toArray() : [],
            'store_name' => $this->seller->name_company,
            'features' => $this->features ? $this->features : [],
            'details' => $this->details ? $this->details : [],
            'is_fav' => $isFav,
            'ratings' => RatingResource::collection($this->ratings),
        ];
    }
}
